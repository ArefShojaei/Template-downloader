<?php

namespace App\Utils;

use App\Interfaces\Asset as AssetInterface;
use PhpX\Utils\Console\Console;


final class Asset implements AssetInterface {
    private static $assets = [];


    public static function __callStatic($name, $params) {
        $className = ucfirst($name);

        $class = __NAMESPACE__ . "\\" . "Assets" . "\\" . $className;
        
        if (!class_exists($class)) die(Console::error("\"{$class}\" class doesn't exist!"));

        $class::add(...$params);
        
        self::$assets[$name] = $class::get();
    }

    public static function get(): array {
        return self::$assets;
    }

    public static function download() {
        foreach (self::get() as $type => $assets) {
            echo Console::info("Downloading {$type} files ...") . PHP_EOL;
            
            foreach ($assets as $link => $meta) {
                $content = Http::get($link);
        
                $folder = dirname(__DIR__, 2) . "/templates" . $meta["path"];
        
                $file = $folder . $meta["file"];
        
                if (!Dir::has($folder)) Dir::create($folder);
        
                if(!File::has($file)) File::save($file, $content);
        
                echo Console::info($file) . PHP_EOL;
            }
        }
    }
}