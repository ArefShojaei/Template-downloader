<?php

namespace App\Modules\Asset;


interface AssetInterface {
    public static function get(): array;
    public static function download(): void;
    public static function defineMeta(string $path, string $file): array;
}