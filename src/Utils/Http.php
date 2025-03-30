<?php

namespace App\Utils;

use GuzzleHttp\Client;
use App\Interfaces\Http as HttpInterface;


final class Http implements HttpInterface {
    public static function get($url): string {
        try {
            $client = new Client;

            $response = $client->request("GET", $url);
        
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\ClientException $error) {
            throw $error->getMessage();
        }
    }
}