<?php

namespace App;

use App\Traits\Client\{
    CanManageAsset,    
    CanManageLink,
    CanRemoveTag
};
use Spider\Page;


final class Client {
    use CanRemoveTag, CanManageLink, CanManageAsset;

    private Page $page;

    private string $url;
    
    private ?string $domain;

    private array $assets;


    public function __construct(Page $page, string $url) {
        $this->page = $page;

        $this->url = $url;
        
        $this->assets = [];
    }

    public function setDomainFromURL(): void {
        $pattern = "/https?\:\/\/(?<domain>[\w._-]+)\..*/";
    
        preg_match($pattern, $this->url, $matches);

        $domain = $matches["domain"];

        $this->domain = $domain;
    }

    public function getDomainFromURL(): ?string {
        return $this->domain;
    }

    public function changeAdditionalTags(): void {
        $this->removeAdditionalMetaTags();

        $this->removeAdditionalLinkTags();
    }

    public function changeExternalLinks(): void {
        $this->changeExternalLinksToHashedValue();
    }
    
    public function setAssets(): void {
        $this->setCssAssetLinks();

        $this->setScriptAssetLinks();

        $this->setMediaAssetLinks();
    }

    public function saveTemplate(string $filename = "index"): void {
        $this->saveAssets();

        $this->saveFile($filename);
    }
}
