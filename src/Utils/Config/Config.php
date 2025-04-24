<?php

namespace App\Utils\Config;

use App\Utils\{
    Fs\File,
    Config\ConfigInterface
};


final class Config implements ConfigInterface {
    private static array $data;

    public static function create(string $file): self {
        $content = File::get($file);

        self::$data = json_decode($content, true);
        
        return new self;
    }

    public function get(string $key = null): mixed {
        if (!$this->has($key)) return null;

        return is_null($key) ? $this->data : $this->data[$key];
    }
    
    private function has(string $key): bool {
        return isset($this->data[$key]);
    }
}