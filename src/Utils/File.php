<?php

namespace App\Utils;

use App\Interfaces\Fs\File as FileInterface;


final class File implements FileInterface {
    public const ARCHIVE_FILE_EXT = ".zip";
    
    public const HTML_FILE_EXT = ".html";
    
    public const CSS_FILE_EXT = ".css";
    
    public const JS_FILE_EXT = ".js";
    
    public const SVG_FILE_EXT = ".svg";
    
    public const PNG_FILE_EXT = ".png";
    
    public const JPEG_FILE_EXT = ".jpeg";
    
    public const JPG_FILE_EXT = ".jpg";

    public const GIF_FILE_EXT = ".gif";
    
    public const WEBP_FILE_EXT = ".webp";
    
    public const WOFF_FILE_EXT = ".woff";
    
    public const WOFF2_FILE_EXT = ".woff2";
    
    public const EOT_FILE_EXT = ".eot";


    public static function save(string $file, mixed $data): bool {
        return @file_put_contents($file, $data);
    }

    public static function get(string $file): string|bool {
        if (!self::has($file)) return false;

        return @file_get_contents($file);
    }

    public static function has(string $file): bool {
        return file_exists($file);
    }
}