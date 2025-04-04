<?php

namespace App\Modules\Client\Providers;


interface CanManageLinkInterface {
    public function changeLinks(): void;
}