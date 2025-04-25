<?php

namespace App\Modules\Asset\Providers;

use App\Modules\Asset\{
    Asset,
    AssetProviderInterface
};
use function App\createAssetProviderFile;


final class Css implements AssetProviderInterface {
    private const ASSET_FOLDER = "/styles/";

    private static array $assets = [];


    public static function add(string $asset): void {
        $pattern = "/(?<filename>[\w_-]+)(?<ext>\..*)/";

        $file = createAssetProviderFile($asset, $pattern);

        $meta = Asset::defineMeta(self::ASSET_FOLDER, $file);
    
        self::$assets[$asset] = $meta;
    }

    public static function get(): array {
        return self::$assets;
    }
}