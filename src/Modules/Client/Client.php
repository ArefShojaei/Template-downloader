<?php

namespace App\Modules\Client;

use Spider\Page;
use App\Modules\Client\ClientInterface as IClient;
use App\Modules\Client\Providers\{
    CanDownloadFile,
    CanManageAsset,
    CanManageFile,
    CanManageLink,
    CanManageTagElement
};


final class Client implements IClient {
    use CanManageTagElement, CanManageLink, CanManageAsset, CanManageFile, CanDownloadFile;

    private Page $page;


    public function __construct(Page $page) {
        $this->page = $page;
    }
}