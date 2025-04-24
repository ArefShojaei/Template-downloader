<?php

namespace App\Utils\Config;


interface ConfigInterface {
    public static function create(string $file): self;
    public function get(string $key = null): mixed;
}