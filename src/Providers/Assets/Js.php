<?php

namespace App\Providers\Assets;

use App\Asset;
use App\Interfaces\AssetProvider as AssetProviderInterface;


final class Js implements AssetProviderInterface {
    private const FOLDER = "/scripts/";

    private static array $assets = [];


    public static function add(string $asset): void {
        $parsedAsset = explode("/", $asset);

        $file = end($parsedAsset);

        $pattern = "/(?<filename>[\w_-]+)(?<ext>\..*)/";

        preg_match($pattern, $file, $matches);

        $file = $matches["filename"] . current(explode("?", $matches["ext"]));

        $meta = Asset::defineMeta(self::FOLDER, $file);
    
        self::$assets[$asset] = $meta;
    }

    public static function get(): array {
        return self::$assets;
    }
}