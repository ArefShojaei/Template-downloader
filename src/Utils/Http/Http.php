<?php 

namespace App\Utils\Http;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use PhpX\Utils\Console\Console;
use App\Utils\Http\HttpInterface;


final class Http implements HttpInterface {
    public const OK = 200;

    public const SUCCESS = "success";

    public const ERROR = "error";


    public static function get($url): array {
        try {
            $client = new GuzzleClient;
            
            $response = $client->request("GET", $url);
            
            return [
                "status" => self::SUCCESS,
                "code" => $response->getStatusCode(),
                "data" => $response->getBody()
            ];
        } catch (Exception $error) {
            return [
                "status" => self::ERROR,
                "error" => $error->getMessage(),
                "message" => Console::error(label:"HTTP", message: "Failed to send HTTP request! - {$url}"),
            ];
        }
    }
}