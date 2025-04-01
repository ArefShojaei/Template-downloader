<?php

namespace App\Utils;

use GuzzleHttp\Client;
use App\Interfaces\Http as HttpInterface;
use PhpX\Utils\Console\Console;


final class Http implements HttpInterface {
    public static function get($url): string {
        try {
            echo Console::info("Sending Http request...", label:"HTTP") . PHP_EOL;
            
            $client = new Client;
            
            $response = $client->request("GET", $url);
            
            echo Console::success("Sent Http request.", label:"HTTP") . PHP_EOL;

            return $response->getBody();
        } catch (\GuzzleHttp\Exception\ConnectException $error) {
            echo Console::error(label:"HTTP", message: "Failed to send HTTP request!") . PHP_EOL;
            
            die(Console::error(label:"HTTP ERROR", message: $error->getMessage()));
        }
    }
}