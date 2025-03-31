<?php

namespace App\Utils;

use App\Interfaces\Fs\Directory as DirectoryInterface;


final class Dir implements DirectoryInterface {
    public static function create(string $path): bool {
        return mkdir($path, recursive:true);
    }

    public static function has(string $path): bool {
        return is_dir($path);
    }
}