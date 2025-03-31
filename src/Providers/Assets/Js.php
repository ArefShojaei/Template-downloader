<?php

namespace App\Providers\Assets;


final class Js {
    private const FOLDER = "/scripts/";

    private static array $assets = [];


    public static function add(string $asset): void {
        $parsedAsset = explode("/", $asset);

        $file = end($parsedAsset);

        $file = str_replace(".min", "", $file);

        $pattern = "/(?<file>[\w_-]+(?<ext>.[css|js|jpeg|jpg|png|webp|svg|git|woff|woff2|eot]+))/";

        preg_match($pattern, $file, $matches);

        $meta = [
            "file" => $matches["file"],
            "path" => "/assets" . self::FOLDER
        ];
    
        self::$assets[$asset] = $meta;
    }

    public static function get(): array {
        return self::$assets;
    }
}