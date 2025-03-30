<?php

namespace App\Utils;

use App\Interfaces\File as FileInterface;


final class File implements FileInterface {
    public static function save(string $file, mixed $data): bool {
        return @file_put_contents($file, $data);
    }

    public static function get(string $file): string|bool {
        if (!self::has($file)) return false;

        return @file_get_contents($file);
    }

    public static function has(string $file): bool {
        return file_exists($file);
    }
}