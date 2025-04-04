<?php

namespace App\Modules\Client\Providers;


interface CanDownloadFileInterface {
    public function downloadAssets(): void;
    public function downloadTemplate(string $filename = "index"): void;
}