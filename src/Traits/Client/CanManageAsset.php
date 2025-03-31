<?php

namespace App\Traits\Client;

use App\Asset;
use App\Utils\File;


trait CanManageAsset {
    public function setCssAssetLinks(): void {
        $this->page->findAll("link[href]")->filter(function($key, $element) {
            $attributes = $element->attr();

            if (preg_match("/\.css/", $attributes["href"])) {
                $asset = $attributes["href"];

                Asset::css($asset);            
            }

        });
    }

    public function setScriptAssetLinks(): void {
        $this->page->findAll("script[src]")->filter(function($key, $element) {
            $attributes = $element->attr();
    
            $pattern = "/\.js/";
            
            foreach ($attributes as $attribute => $value) {
                if (!preg_match($pattern, $value)) continue;

                Asset::js($value);
            }
        });
    }

    public function setMediaAssetLinks(): void {
        $this->page->findAll("img")->each(function($key, $img) {
            $attributes = $img->attr();

            $pattern = "/\.(jpe?g|png|webp|svg|gift)$/";
            
            foreach ($attributes as $attribute => $value) {
                if (!preg_match($pattern, $value)) continue;

                Asset::media($value);
            }
        });
    }

    public function getAssetLinks(): array {
        return $this->assets;
    }

    public function saveAssets(): void {
        Asset::download();
    }

    public function saveFile(string $filename): void {
        $html = $this->page->display();

        foreach (Asset::get() as $type => $data) {
            foreach ($data as $link => $meta) {
                $html = str_replace($link, "/templates" . $meta["path"] . $meta["file"], $html);
            }
        }

        $html = str_replace($this->url, "/templates", $html);

        File::save(dirname(__DIR__, 3) . "/templates/" . $filename . File::HTML_FILE_EXT, $html);
    }
}