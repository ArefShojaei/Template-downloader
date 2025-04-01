<?php

namespace App;

use App\Interfaces\Asset as AssetInterface;
use PhpX\Utils\Console\Console;
use App\Utils\{
    Dir,
    File,
    Http,
    URL
};


final class Asset implements AssetInterface {
    private const PROVDERS_PATH = "\\Providers\\Assets\\";

    private const RELATIVE_ASSET_FOLDER = "/dist/";

    private static array $assets = [];


    public static function __callStatic($name, $params) {
        $className = ucfirst($name);

        $class = __NAMESPACE__ . self::PROVDERS_PATH . $className;
        
        if (!class_exists($class)) die(Console::error("\"{$class}\" class doesn't exist!"));

        $class::add(...$params);
        
        self::$assets[$name] = $class::get();
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
        foreach (self::get() as $type => $assets) {
            echo Console::info(label:"ASSET", message:"Downloading \"{$type}\" asset files...") . PHP_EOL;
            
            foreach ($assets as $link => $meta) {
                $content = Http::get($link);

                $domain = URL::domain();

                $folder = dirname(__DIR__) . self::RELATIVE_ASSET_FOLDER . (!is_null($domain) ? $domain . "/" : "") . ltrim($meta["path"], "/");
        
                $file = $folder . $meta["file"];
        
                if (!Dir::has($folder)) Dir::create($folder);
        
                if(!File::has($file)) File::save($file, $content);
        
                echo Console::warn(label:strtoupper($type), message:$file) . PHP_EOL;
            }
        }
    }
}