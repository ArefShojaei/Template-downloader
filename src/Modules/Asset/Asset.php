<?php

namespace App\Modules\Asset;

use App\Modules\Asset\AssetInterface;
use PhpX\Utils\Console\Console;
use App\Utils\{
    Fs\Directory,
    Fs\File,
    Http\Http,
};
use function App\getAssetProviderFile;


final class Asset implements AssetInterface {
    private const PROVDERS_FOLDER = "\\Providers\\";

    private const RELATIVE_ASSET_FOLDER = "/dist/";

    private static array $assets = [];


    public static function __callStatic($name, $params) {
        $assetTypeClassName = ucfirst($name);

        $assetTypeClass = __NAMESPACE__ . self::PROVDERS_FOLDER . $assetTypeClassName;
        
        if (!class_exists($assetTypeClass)) die(Console::error("\"{$assetTypeClass}\" class doesn't exist!"));

        $assetTypeClass::add(...$params);
        
        self::$assets[$name] = $assetTypeClass::get();
    }

    public static function get(): array {
        return self::$assets;
    }

    public static function defineMeta(string $folder, string $file): array {
        return [
            "file" => $file,
            "path" => "/assets" . $folder
        ];
    }

    public static function download(): void {
        if (self::isEmpty()) {
            foreach (self::get() as $type => $assets) {
                echo Console::info(label:"ASSET", message:"Downloading \"{$type}\" asset files...") . PHP_EOL;
                
                foreach ($assets as $link => $meta) {
                    $response = Http::get($link);
    
                    if ($response["status"] === Http::OK) {
                        $content = $response["data"];
        
                        [$folder, $file] =  getAssetProviderFile(
                            path: dirname(__DIR__, 3) . self::RELATIVE_ASSET_FOLDER,
                            meta: $meta
                        );
                
                        if (!Directory::has($folder)) Directory::create($folder);
                
                        if(!File::has($file)) File::save($file, $content);
                
                        echo Console::warn(label:strtoupper($type), message:$link) . PHP_EOL;
                    }
                }
            }
        }
    }

    public static function isEmpty(): bool {
        return empty(self::get());
    }
}