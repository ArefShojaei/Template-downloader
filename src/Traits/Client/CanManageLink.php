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

    public function hashExternalLinks(): void {
        $this->page->findAll("a[href]")->each(function($key, $anchor) {
            $attributes = $anchor->attr();

            $domain = $this->getDomainFromURL();

            foreach ($attributes as $attribute => $value) {
                if (str_contains($domain, $value)) continue;

                unset($attributes["href"]);

                $anchor->attr("href", "#");
            }
        });
    }

    public function hashLocalLinks(): void {
        $this->page->findAll("a[href]")->each(function($key, $anchor) {
            $attributes = $anchor->attr();

            $domain = $this->getDomainFromURL();

            foreach ($attributes as $attribute => $value) {
                if (!str_contains($domain, $value)) continue;

                unset($attributes["href"]);

                $anchor->attr("href", "#");
            }
        });
    }
}