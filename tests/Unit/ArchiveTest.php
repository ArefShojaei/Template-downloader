<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Archive\{
    Archive,
    ArchiveInterface as IArchive
};


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
    public function addArchiveFile(Archive $archive): void {
        $externalFile = "template.config.json";

        $result = $archive->addFile($externalFile);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @depends createArchive
     */
    public function addArchiveComment(Archive $archive): void {
        $result = $archive->addComment("My Archive File!");

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @depends createArchive
     */
    public function exportArchiveWithAllThings(Archive $archive): void {
        $result = $archive->save();

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function checkToImplementArchiveInterface(): void {
        $interfaces = class_implements(Archive::class);

        $this->assertArrayHasKey(IArchive::class, $interfaces);
    }
}