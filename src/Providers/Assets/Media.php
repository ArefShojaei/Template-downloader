<?php

namespace App\Providers\Assets;


final class Media {
    private const FOLDER = "/images/";

    private static array $assets = [];


    public static function add(string $asset): void {
        $parsedAsset = explode("/", $asset);

        $file = end($parsedAsset);

        $pattern = "/(?<filename>[\w_-]+)(?<ext>\..*)/";

        preg_match($pattern, $file, $matches);

        $file = $matches["filename"] . current(explode("?", $matches["ext"]));

        $meta = [
            "file" => $file,
            "path" => "/assets" . self::FOLDER
        ];
    
        self::$assets[$asset] = $meta;
    }

    public static function get(): array {
        return self::$assets;
    }
}