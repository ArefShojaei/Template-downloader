<?php

namespace App\Interfaces;


interface URL {
    public static function set(string $url): void;
    public static function get(): ?string;
    public static function domain(): ?string;
}