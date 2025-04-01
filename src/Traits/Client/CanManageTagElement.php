<?php

namespace App\Traits\Client;


trait CanManageTagElement {
    private function removeAdditionalMetaTags(): void {
        $this->page->findAll("meta")->each(function ($key, $meta) {
            $key++;

            if (!str_contains($meta->html(), "charset") && !str_contains($meta->html(), "viewport")) $meta->remove();
        });
    }

    private function removeAdditionalLinkTags(): void {
        $this->page->findAll("link")->each(function ($key, $link) {
            $key++;

            if (!str_contains($link->html(), "stylesheet")) $link->remove();
        });
    }

    public function changeAdditionalTags(): void {
        $this->removeAdditionalMetaTags();

        $this->removeAdditionalLinkTags();
    }
}