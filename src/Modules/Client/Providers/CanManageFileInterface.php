<?php

namespace App\Modules\Client\Providers;


interface CanManageFileInterface {
    public function saveArchive(string $comment = null): void;
}