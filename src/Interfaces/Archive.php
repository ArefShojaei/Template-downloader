<?php

namespace App\Interfaces;


interface Archive {
    public function addFile(string $file): bool;
    public function save(): bool;
}