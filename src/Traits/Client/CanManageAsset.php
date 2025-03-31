<?php

namespace App\Traits\Client;

use App\Asset;
use App\Utils\File;


trait CanManageAsset {
    public function setCssAssetLinks(): void {
        $this->page->findAll("link[href]")->filter(function($key, $element) {
            $attributes = $element->attr();

            if (array_key_exists("href", $attributes) && str_contains($attributes["href"], $this->url)) {
                $asset = $attributes["href"];
                
                Asset::css($asset);
            }
        });
    }

    public function setScriptAssetLinks(): void {
        $this->page->findAll("script[src]")->filter(function($key, $element) {
            $attributes = $element->attr();
    
            if (array_key_exists("src", $attributes) && str_contains($attributes["src"], $this->url)) {
                $asset = $attributes["src"];
                
                Asset::js($asset);
            }
        });
    }

    public function setMediaAssetLinks(): void {
        $this->page->findAll("img[src]")->each(function($key, $img) {
            if (str_starts_with($img->html(), "<img")) {
                $attributes = $img->attr();

                if (array_key_exists("src", $attributes) && str_contains($attributes["src"], $this->url) && strripos($attributes["src"], ".")) {
                    $asset = $attributes["src"];

                    Asset::media($asset);
                }
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

        $html = str_replace($this->url, "/templates/", $html);
        $html = str_replace(".min", "", $html);

        File::save(dirname(__DIR__, 2) . "/templates/" . $filename . File::HTML_FILE_EXT, $html);
    }
}