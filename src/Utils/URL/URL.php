<?php

namespace App\Utils\URL;

use App\Utils\URL\URLInterface;


final class URL implements URLInterface {
    private static ?string $url;

    public static function set(string $url): void {
        self::$url = $url;
    }

    public static function get(): ?string {
        if (self::isEmpty()) return null;
        
        return self::$url;
    }

    public static function domain(): ?string {
        if (self::isEmpty()) return null;

        $parsedHost = explode(".", parse_url(self::$url)["host"]);

        array_pop($parsedHost);

        return implode(".", $parsedHost);
    }
    
    private static function isEmpty(): bool {
        return empty(self::$url);
    }
}