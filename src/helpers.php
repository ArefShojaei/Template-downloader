<?php

namespace App;

use Spider\Spider;
use App\Client;
use App\Utils\{
    Http,
    URL
};


function replaceRelativeToAbsoluteLink(string $html, string $url): string {
    $pattern = "/(?<attr>[a-z-]*?src|href)\s*=['\"](?<src>(?!https?)(?!\/\/)[\w\:\/\.\&\?\=\-\_\%]+)['\"]/";
        
    return preg_replace_callback($pattern, function($matches) use ($url) {
        $attr = $matches["attr"];
        $src = $matches["src"];

        $src = rtrim($url, "/") . (!str_starts_with($src, "/") ? "/" . $src : $src);
        
        return "{$attr}=\"{$src}\"";
    }, $html);
}

function replaceFormActionURLToHashedValue(string $html): string {
    $pattern = "/action\s*=['\"]\s*(?<url>[\w\:\/\.\&\?\=\-\_\%]+)\s*['\"]/";
    
    return preg_replace_callback($pattern, function($matches) {
        $value = "#";

        return "action=\"{$value}\"";
    }, $html);
}

function serveProject(string $url): bool {
    $html = Http::get($url);
    
    $html = replaceRelativeToAbsoluteLink($html, $url);

    $html = replaceFormActionURLToHashedValue($html);

    $spider = new Spider;
    
    $page = $spider->loadHTML($html);

    URL::set($url);
    
    $client = new Client($page);

    $client->changeAdditionalTags();
    
    $client->changeLinks();

    $client->downloadAssets();

    $client->downloadTemplate();

    $client->saveArchive();

    return true;
}