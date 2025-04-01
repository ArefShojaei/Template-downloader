<?php

namespace App\Interfaces;


interface CanManageFile {
    public function saveArchive(string $comment = null): void;
}

interface CanDownloadFile {
    public function downloadAssets(): void;
    public function downloadTemplate(string $filename = "index"): void;
}

interface CanManageLink {
    public function changeLinks(): void;
}

interface CanManageTagElement {
    public function changeAdditionalTags(): void;
}

interface Client extends
    CanManageFile,
    CanDownloadFile, 
    CanManageLink,
    CanManageTagElement {}