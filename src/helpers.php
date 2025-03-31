<?php

namespace App;


function replaceRelativeToAbsolutePath(string $html, string $url): string {
    $pattern = "/(?<attr>[a-z-]*?src|href)\s*=['\"](?<src>.+)['\"]/";
        
    return preg_replace_callback($pattern, function($matches) use ($url) {
        $attr = $matches["attr"];
        $src = $matches["src"];
        
        preg_match("/https?:\/\/(?<domain>[\w\.]+)/", $url, $urlMatches);
        
        if (preg_match("/" . $urlMatches["domain"] . "|http"  ."/", $src)) return "{$attr}=\"{$src}\"";

        $src = rtrim($url, "/") . (!str_starts_with($matches["src"], "/") ? "/" . $matches["src"] : $matches["src"]);

        return "{$attr}=\"{$src}\"";
    }, $html);
}