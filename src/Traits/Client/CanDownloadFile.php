<?php

namespace App\Traits\Client;


trait CanDownloadFile {
    public function downloadAssets(): void {
        $this->setAssets();
                
        $this->saveAssets();
    }

    public function downloadTemplate(string $filename = "index"): void {
        $this->saveTemplate($filename);
    }
}