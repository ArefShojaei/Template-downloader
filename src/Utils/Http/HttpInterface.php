<?php

namespace App\Utils\Http;


interface HttpInterface {
    public static function get(string $url): array;
}