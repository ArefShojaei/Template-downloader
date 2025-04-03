<?php 

namespace App\Utils;

use Exception;
use GuzzleHttp\Client;
use PhpX\Utils\Console\Console;
use App\Interfaces\Http as HttpInterface;


final class Http implements HttpInterface {
    public const SUCCESS = "success";

    public const ERROR = "error";


    public static function get($url): array {
        try {
            $client = new Client;
            
            $response = $client->request("GET", $url);
            
            return [
                "status" => self::SUCCESS,
                "code" => $response->getStatusCode(),
                "data" => $response->getBody()
            ];
        } catch (Exception $error) {
            echo Console::error(label:"HTTP", message: "Failed to send HTTP request!") . PHP_EOL;
            
            return [
                "status" => self::ERROR,
                "message" => $error->getMessage()
            ];
        }
    }
}