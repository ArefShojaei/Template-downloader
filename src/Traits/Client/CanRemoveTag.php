<?php

namespace App\Traits\Client;

use PhpX\Utils\Console\Console;


trait CanRemoveTag {
    public function removeAdditionalMetaTags(): void {
        $this->page->findAll("meta")->each(function ($key, $meta) {
            $key++;

            echo Console::info("Clearning meta tag #{$key} ...") . PHP_EOL;

            if (!str_contains($meta->html(), "charset") && !str_contains($meta->html(), "viewport")) $meta->remove();
        });
    }

    public function removeAdditionalLinkTags(): void {
        $this->page->findAll("link")->each(function ($key, $link) {
            $key++;

            echo Console::info("Clearning link tag #{$key} ...") . PHP_EOL;

            if (!str_contains($link->html(), "stylesheet")) $link->remove();
        });
    }
}