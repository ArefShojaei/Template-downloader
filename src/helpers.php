<?php

namespace App;

use App\Modules\Client\{
    Client,
    ClientBuilder
};
use App\Utils\{
    Fs\Directory,
    Fs\File,
    Http\Http,
    URL\URL,
};
use PhpX\Utils\Console\Console;


function replaceRelativeToAbsoluteLink(string $html, string $url): string {
    $pattern = "/(?<attr>[a-z-]*?src|href)\s*=['\"](?<src>(?!https?)(?!\/\/)[\w\:\/\.\&\?\=\-\_\%]+)['\"]/";
        
    $parsedURL = explode("/", $url);

    $lastPath = end($parsedURL);

    if (str_contains($lastPath, ".html")) array_pop($parsedURL);

    $url = implode("/", $parsedURL);

    return preg_replace_callback($pattern, function($matches) use ($url) {
        $attr = $matches["attr"];

        $src = $matches["src"];

        $src = ltrim($src, ".");

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

function createAssetProviderFile(string $asset, string $pattern): string {
    $parsedAsset = explode("/", $asset);

    $file = end($parsedAsset);

    preg_match($pattern, $file, $matches);

    return $matches["filename"] . current(explode("?", $matches["ext"]));
}

function serveTemplate(string $url, string $filename = "index"): Client {
    $client = (new ClientBuilder($url))
        ->setHttpDomain()
        ->setHttpRequest()
        ->setHtmlContentChanger()
        ->setPageLoader()
        ->build();

    $client->changeAdditionalTags();
    
    $client->changeLinks();

    $client->downloadAssets();

    $client->downloadTemplate($filename);

    return $client;
}

function downloadTemplateFonts(array $fonts): void {
    foreach ($fonts as $font) {
        URL::set($font);

        $content = Http::get($font);

        $parsedFont = explode("/", $font);

        $file = end($parsedFont);

        $domain = URL::domain();

        $folder = __DIR__ . "/dist/" . (!is_null($domain) ? $domain . "/" : "") . "fonts/";

        $fontFile = $folder . $file;

        if (!Directory::has($folder)) Directory::create($folder);
        
        if(!File::has($fontFile)) File::save($fontFile, $content["data"]);
    }
}

function downloadTemplatePages(array $pages): Client {
    foreach ($pages as $filename => $url) {
        echo Console::info(label:"Child TASK", message:"Starting \"{$url}\" child template task...") . PHP_EOL;
        
        $client = serveTemplate($url, $filename);

        echo Console::success(label:"Child TASK", message:"Done the child template task.") . PHP_EOL;
    }

    return $client;
}

function getAssetProviderFile(string $path, array $meta): array {
    $domain = URL::domain();

    $folder = $path . (!is_null($domain) ? $domain . "/" : "") . ltrim($meta["path"], "/");

    $file = $folder . $meta["file"];

    return [$folder, $file];
}