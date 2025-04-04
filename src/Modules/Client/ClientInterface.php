<?php

namespace App\Modules\Client;

use App\Modules\Client\Providers\{
    CanDownloadFileInterface,
    CanManageFileInterface,
    CanManageLinkInterface,
    CanManageTagElementInterface,
};


interface ClientInterface extends
    CanManageFileInterface,
    CanDownloadFileInterface, 
    CanManageLinkInterface,
    CanManageTagElementInterface {}