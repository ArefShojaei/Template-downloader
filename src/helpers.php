<?php

namespace App;

use PhpX\Utils\Console\Console;


function replaceRelativeToAbsoluteLink(string $html, string $url): string {
    echo Console::info(label:"LINK", message: "Replacing relative to absolute link") . PHP_EOL;
    
    $pattern = "/(?<attr>[a-z-]*?src|href)\s*=['\"](?<src>(?!https?)[\w\:\/\.\&\?\=\-\_\%]+)['\"]/";
        
    $result = preg_replace_callback($pattern, function($matches) use ($url) {
        $attr = $matches["attr"];
        $src = $matches["src"];

        echo Console::error(label:"RELATIVE", message: $src) . PHP_EOL;
        
        $src = rtrim($url, "/") . (!str_starts_with($src, "/") ? "/" . $src : $src);
        
        echo Console::warn(label:"ABSOLUTE", message: $src) . PHP_EOL;
        
        return "{$attr}=\"{$src}\"";
    }, $html);

    echo Console::success(label:"LINK", message: "Replaced relative to absolute link") . PHP_EOL;

    return $result;
}

function replaceFormActionURLToHashedValue(string $html): string {
    echo Console::info(label:"FORM", message: "Replacing form action url to hashed value") . PHP_EOL;
    
    $pattern = "/action\s*=['\"]\s*(?<url>[\w\:\/\.\&\?\=\-\_\%]+)\s*['\"]/";
    
    $result = preg_replace_callback($pattern, function($matches) {
        $src = $matches["url"];

        echo Console::error(label:"URL", message: $src) . PHP_EOL;
        
        $src = "#";
        
        echo Console::warn(label:"HASHED", message: $src) . PHP_EOL;
        
        return "action=\"{$src}\"";
    }, $html);

    echo Console::success(label:"FORM", message: "Replaced form action url to hashed value") . PHP_EOL;

    return $result;
}