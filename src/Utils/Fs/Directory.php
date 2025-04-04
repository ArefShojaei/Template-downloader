<?php

namespace App\Utils\Fs;

use App\Utils\Fs\DirectoryInterface;


final class Directory implements DirectoryInterface {
    public static function create(string $path): bool {
        return mkdir($path, recursive:true);
    }

    public static function has(string $path): bool {
        return is_dir($path);
    }
}