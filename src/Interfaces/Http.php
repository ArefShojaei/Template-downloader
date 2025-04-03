<?php

namespace App\Interfaces;


interface Http {
    public static function get(string $url): array;
}