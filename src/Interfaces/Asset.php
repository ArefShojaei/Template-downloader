<?php

namespace App\Interfaces;


interface Asset {
    public static function get(): array;
    public static function download(): void;
    public static function defineMeta(string $path, string $file): array;
}

interface AssetProvider {
    public static function add(string $asset): void;
    public static function get(): array;
}