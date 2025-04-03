<?php

namespace Tests\Unit;

use App\Interfaces\Http as HttpInterface;
use App\Utils\Http;
use PHPUnit\Framework\TestCase;


final class HttpTest extends TestCase {
    private function getUrlProviders(): array {
        return [
            ["https://google.com"],
            ["https://stackoverflow.com"],
            ["https://php.net"],

            ["https://react.info"],
            ["https://m.org"],
            ["https://wp.net"],
        ];
    }

    private function getValidUrlProviders(): array {
        return [
            ["https://google.com"],
            ["https://stackoverflow.com"],
            ["https://php.net"],
        ];
    }

    private function getInvalidUrlProviders(): array {
        return [
            ["https://auth.test.design"],
            ["https://test.org/pages"],
            ["https://test.ac"],
        ];
    }

    /**
     * @test
     * @dataProvider getUrlProviders
     */
    public function sendHttpGetRequest($url) {
        $response = Http::get($url);

        $this->assertIsArray($response);
    }

    /**
     * @test
     * @dataProvider getValidUrlProviders
     */
    public function sendSuccessHttpGetRequest(string $url) {
        $response = Http::get($url);

        $this->assertIsArray($response);
        
        $this->assertArrayHasKey("status", $response);
        $this->assertIsString($response["status"]);
        $this->assertEquals(Http::SUCCESS, $response["status"]);
        
        $this->assertArrayHasKey("code", $response);
        $this->assertIsInt($response["code"]);
        $this->assertEquals(Http::OK, $response["code"]);

        $this->assertArrayHasKey("data", $response);
        $this->assertIsObject($response["data"]);
    }

    /**
     * @test
     * @dataProvider getInvalidUrlProviders
     */
    public function sendFailedHttpGetRequest(string $url) {
        $response = Http::get($url);

        $this->assertIsArray($response);
        
        $this->assertArrayHasKey("status", $response);
        $this->assertIsString($response["status"]);
        $this->assertEquals(Http::ERROR, $response["status"]);
        
        $this->assertArrayNotHasKey("code", $response);
        $this->assertArrayNotHasKey("data", $response);
        
        $this->assertArrayHasKey("error", $response);
        $this->assertIsString($response["error"]);

        $this->assertArrayHasKey("message", $response);
        $this->assertIsString($response["message"]);
    }

    /**
     * @test
     */
    public function checkToImplementHttpInterface() {
        $interfaces = class_implements(Http::class);

        $this->assertArrayHasKey(HttpInterface::class, $interfaces);
    }
}