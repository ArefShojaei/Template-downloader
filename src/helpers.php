<?php

namespace App;


function replaceRelativeToAbsoluteLink(string $html, string $url): string {
    $pattern = "/(?<attr>[a-z-]*?src|href)\s*=['\"](?<src>(?!https?)[\w\:\/\.\&\?\=\-\_\%]+)['\"]/";
        
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