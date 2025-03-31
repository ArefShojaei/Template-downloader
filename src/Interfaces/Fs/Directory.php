<?php

namespace App\Interfaces\Fs;


interface Directory {
    public static function create(string $path): bool;
    public static function has(string $path): bool;
}