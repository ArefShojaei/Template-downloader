<?php

namespace App\Interfaces;


interface CanManageAssetInterface {
    public function setCssAssetLinks(): void;
    public function setScriptAssetLinks(): void;
    public function setMediaAssetLinks(): void;
    public function getAssetLinks(): array;
    public function saveAssets(): void;
    public function saveFile(string $filename): void;
}

interface CanManageLinkInterface {
    public function hashExternalLinks(): void;
}

interface CanRemoveTagInterface {
    public function removeAdditionalMetaTags(): void;
    public function removeAdditionalLinkTags(): void;
}


interface Client extends
    CanRemoveTagInterface,
    CanManageLinkInterface,
    CanManageLinkInterface {
        public function setDomainFromURL(): void;
        public function getDomainFromURL(): ?string;
        public function changeAdditionalTags(): void;
        public function changeExternalLinks(): void;
        public function setAssets(): void;
        public function saveTemplate(string $filename = "index"): void;
    }