<?php

namespace App\Utils\URL;


interface URLInterface {
    public static function set(string $url): void;
    public static function get(): ?string;
    public static function domain(): ?string;
}