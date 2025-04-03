<?php

namespace Tests\Unit;

use App\Interfaces\Archive as ArchiveInterface;
use App\Utils\Archive;
use PHPUnit\Framework\TestCase;


final class ArchiveTest extends TestCase {
    /**
     * @test
     */
    public function createArchive(): Archive {
        $archiveFile = "app.zip";

        $archive = new Archive($archiveFile);

        $this->assertIsObject($archive);
        $this->assertInstanceOf(Archive::class, $archive);

        return $archive;
    }

    /**
     * @test
     * @depends createArchive
     */
    public function addArchiveFile(Archive $archive) {
        $externalFile = "template.config.json";

        $result = $archive->addFile($externalFile);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @depends createArchive
     */
    public function addArchiveComment(Archive $archive) {
        $result = $archive->addComment("My Archive File!");

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @depends createArchive
     */
    public function exportArchiveWithAllThings(Archive $archive) {
        $result = $archive->save();

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function checkToImplementArchiveInterface() {
        $interfaces = class_implements(Archive::class);

        $this->assertArrayHasKey(ArchiveInterface::class, $interfaces);
    }
}