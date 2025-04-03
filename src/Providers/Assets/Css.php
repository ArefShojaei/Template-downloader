<?php

namespace App\Providers\Assets;

use App\Asset;
use App\Interfaces\AssetProvider as AssetProviderInterface;
use function App\createAssetProviderFile;


final class Css implements AssetProviderInterface {
    private const FOLDER = "/styles/";

    private static array $assets = [];


    public static function add(string $asset): void {
        $pattern = "/(?<filename>[\w_-]+)(?<ext>\..*)/";

        $file = createAssetProviderFile($asset, $pattern);

        $meta = Asset::defineMeta(self::FOLDER, $file);
    
        self::$assets[$asset] = $meta;
    }

    public static function get(): array {
        return self::$assets;
    }
}