<?php

namespace App\Traits\Client;

use App\Asset;
use App\Utils\{
    Archive,
    File,
    URL
};


trait CanManageFile {
    private function saveTemplate(string $filename): void {
        $html = $this->page->display();

        foreach (Asset::get() as $type => $data) {
            foreach ($data as $link => $meta) {
                $assetFile = $meta["path"] . $meta["file"];

                $html = str_replace($link, $assetFile, $html);
            }
        }

        $domain = URL::domain();

        $templateFile = dirname(__DIR__, 3) . "/dist/" . (!is_null($domain) ? $domain . "/" : "") . $filename . File::HTML_FILE_EXT;

        File::save($templateFile , $html);
    }

    private function saveAssets(): void {
        Asset::download();
    }

    public function saveArchive(string $comment = null): void {
        $domain = URL::domain();
        $path = "dist/" . $domain;

        $templatePattern = $path . "/*.html";
        $assetPattern = $path . "/**/**/**";
    
        $files = [...glob($templatePattern), ...glob($assetPattern)];

        
        $zip = new Archive($path = "dist/" . $domain . File::ARCHIVE_FILE_EXT);

        foreach ($files as $file) {
            $zip->addFile($file, ltrim($file, $path));
        }

        $zip->addComment($comment ?? "");

        $zip->save();
    }
}