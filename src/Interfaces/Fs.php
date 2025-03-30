<?php

namespace App\Interfaces;


interface File {
    public static function save(string $file, mixed $data): bool;
    public static function get(string $file): string|bool;
    public static function has(string $file): bool;
}

interface Directory {
    public static function create(string $path): bool;
    public static function has(string $path): bool;
}