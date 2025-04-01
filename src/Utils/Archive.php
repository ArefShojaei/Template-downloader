<?php

namespace App\Utils;

use App\Interfaces\Archive as ArchiveInterface;
use ZipArchive;


final class Archive implements ArchiveInterface {
    private ZipArchive $zip;
    

    public function __construct(string $file) {
        $this->zip = new ZipArchive;

        $this->zip->open($file, ZipArchive::CREATE);
    }

    public function addFile(string $file, string $name = null): bool {
        return $this->zip->addFile($file, $name);
    }

    public function addComment(string $message): bool {
        return $this->zip->setArchiveComment($message);
    }

    public function save(): bool {
        return $this->zip->close();
    }
}