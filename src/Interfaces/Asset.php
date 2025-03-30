<?php

namespace App\Interfaces;


interface Asset {
    public static function get(): array;
    public static function download();
}