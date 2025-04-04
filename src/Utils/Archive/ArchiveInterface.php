<?php

namespace App\Utils\Archive;


interface ArchiveInterface {
    public function addFile(string $file, string $name = null): bool;
    public function addComment(string $message): bool;
    public function save(): bool;
}