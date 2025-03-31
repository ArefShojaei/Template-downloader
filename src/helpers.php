<?php

namespace App;


function replaceRelativeToAbsolutePath(string $html, string $url): string {
    $pattern = "/(?<attr>src|href)\s*=['\"](?<src>[\w\/._-]+)['\"]/";
        
    return preg_replace_callback($pattern, function($matches) use ($url) {
        $src = $url . $matches["src"];
        $attr = $matches["attr"];

        return "{$attr}=\"{$src}\"";
    }, $html);
}