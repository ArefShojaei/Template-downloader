<?php

namespace App\Modules\Client\Providers;

use App\Modules\Asset\Asset;
use App\Utils\{
    Archive\Archive,
    Fs\Directory,
    Fs\File,
    URL\URL
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

        $folder = dirname(__DIR__, 4) . "/dist/" . (!is_null($domain) ? $domain . "/" : "");

        $templateFile = $folder . $filename . File::HTML_FILE_EXT;

        if (!Directory::has($folder)) Directory::create($folder);
        
        if(!File::has($templateFile)) File::save($templateFile, $html);
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