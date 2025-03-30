<?php

namespace App\Traits\Client;


trait CanManageLink {
    public function replaceExternalLinksToHashedValue() {
        $this->page->findAll("a[href]")->each(function($key, $anchor) {
            if (str_starts_with($anchor->html(), "<a")) {
                $attributes = $anchor->attr();
    
                if (array_key_exists("href", $attributes))
                    unset($attributes["href"]);
    
                    $anchor->attr("href", "#");
            }
        });
    }
}