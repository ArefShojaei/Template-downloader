<?php

namespace App\Traits\Client;


trait CanManageLink {
    public function hashLinks(): void {
        $this->page->findAll("a[href]")->each(function($key, $anchor) {
            $attributes = $anchor->attr();

            unset($attributes["href"]);

            $anchor->attr("href", "#");
        });        
    }
}