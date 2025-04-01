<?php

namespace App\Interfaces;


interface Client {
    public function changeAdditionalTags(): void;
    public function changeLinks(): void;
    public function saveAssets(): void;
    public function saveTemplate(string $filename = "index"): void;
    public function saveArchive(string $comment = null): void;
}