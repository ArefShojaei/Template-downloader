<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Utils\Http\{
    Http,
    HttpInterface as IHttp
};


final class HttpTest extends TestCase {
    private function getUrlProviders(): array {
        return [
            # Valid
            ["https://google.com"],
            ["https://stackoverflow.com"],
            ["https://php.net"],
            # Invalid
            ["https://auth.com/page"],
            ["https://laravel.tk"],
            ["https://auth.token.info"],
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
            ["https://auth.com/page"],
            ["https://laravel.tk"],
            ["https://auth.token.info"],
        ];
    }

    /**
     * @test
     * @dataProvider getUrlProviders
     */
    public function sendHttpGetRequest($url): void {
        $response = Http::get($url);

        $this->assertIsArray($response);
    }

    /**
     * @test
     * @dataProvider getValidUrlProviders
     */
    public function sendSuccessHttpGetRequest(string $url): void {
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
    public function sendFailedHttpGetRequest(string $url): void {
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
    public function checkToImplementHttpInterface(): void {
        $interfaces = class_implements(Http::class);

        $this->assertArrayHasKey(IHttp::class, $interfaces);
    }
}