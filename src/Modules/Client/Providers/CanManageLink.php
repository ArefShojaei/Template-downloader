<?php

namespace App\Modules\Client\Providers;


trait CanManageLink {
    private function hashLinks(): void {
        $this->page->findAll("a[href]")->each(function($key, $anchor) {
            $attributes = $anchor->attr();

            unset($attributes["href"]);

            $anchor->attr("href", "#");
        });        
    }

    public function changeLinks(): void {
        $this->hashLinks();
    }
}