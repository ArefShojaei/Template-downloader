<?php

namespace App;

use App\Interfaces\Client as ClientInterface;
use App\Traits\Client\{
    CanDownloadFile,
    CanManageAsset,
    CanManageFile,
    CanManageLink,
    CanManageTagElement
};
use Spider\Page;


final class Client implements ClientInterface {
    use CanManageTagElement, CanManageLink, CanManageAsset, CanManageFile, CanDownloadFile;

    private Page $page;

    private array $assets;


    public function __construct(Page $page) {
        $this->page = $page;

        $this->assets = [];
    }
}