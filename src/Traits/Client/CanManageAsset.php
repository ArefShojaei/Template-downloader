<?php

namespace App\Traits\Client;

use App\Asset;


trait CanManageAsset {
    private function setCssAssetLinks(): void {
        $this->page->findAll("link[href]")->filter(function($key, $element) {
            $attributes = $element->attr();

            if (preg_match("/\.css/", $attributes["href"])) {
                $asset = $attributes["href"];

                Asset::css($asset);            
            }
        });
    }

    private function setScriptAssetLinks(): void {
        $this->page->findAll("script[src]")->filter(function($key, $element) {
            $attributes = $element->attr();
    
            $pattern = "/\.js/";
            
            foreach ($attributes as $attribute => $value) {
                if (!preg_match($pattern, $value)) continue;

                Asset::js($value);
            }
        });
    }

    private function setMediaAssetLinks(): void {
        $this->page->findAll("img")->each(function($key, $img) {
            $attributes = $img->attr();

            $pattern = "/\.(jpe?g|png|webp|svg|gift)$/";
            
            foreach ($attributes as $attribute => $value) {
                if (!preg_match($pattern, $value)) continue;

                Asset::media($value);
            }
        });
    }

    private function setAssets(): void {
        $this->setCssAssetLinks();

        $this->setScriptAssetLinks();

        $this->setMediaAssetLinks();
    }

    private function getAssetLinks(): array {
        return $this->assets;
    }
}