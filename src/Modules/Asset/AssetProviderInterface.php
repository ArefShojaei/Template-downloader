<?php

namespace App\Modules\Asset;


interface AssetProviderInterface {
    public static function add(string $asset): void;
    public static function get(): array;
}