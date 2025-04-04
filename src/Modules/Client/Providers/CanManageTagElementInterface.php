<?php

namespace App\Modules\Client\Providers;


interface CanManageTagElementInterface {
    public function changeAdditionalTags(): void;
}