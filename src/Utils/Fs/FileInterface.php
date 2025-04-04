<?php

namespace App\Utils\Fs;


interface FileInterface {
    public static function save(string $file, mixed $data): bool;
    public static function get(string $file): string|bool;
    public static function has(string $file): bool;
}