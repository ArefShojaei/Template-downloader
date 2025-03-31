<?php

namespace App;

use App\Interfaces\Asset as AssetInterface;
use PhpX\Utils\Console\Console;
use App\Utils\{
    Dir,
    File,
    Http
};


final class Asset implements AssetInterface {
    private const PROVDERS_PATH = "\\Providers\\Assets\\";

    private const RELATIVE_ASSET_FOLDER = "/templates";

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

    public static function download(): void {
        foreach (self::get() as $type => $assets) {
            echo Console::info("Downloading {$type} files ...") . PHP_EOL;
            
            foreach ($assets as $link => $meta) {
                $content = Http::get($link);
        
                $folder = dirname(__DIR__) . self::RELATIVE_ASSET_FOLDER . $meta["path"];
        
                $file = $folder . $meta["file"];
        
                if (!Dir::has($folder)) Dir::create($folder);
        
                if(!File::has($file)) File::save($file, $content);
        
                echo Console::info($file) . PHP_EOL;
            }
        }
    }
}