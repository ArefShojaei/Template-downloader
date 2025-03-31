<?php

namespace App\Utils;

use App\Traits\Client\{
    CanManageAsset,    
    CanManageLink,
    CanRemoveTag
};
use Spider\Page;


final class Client {
    use CanRemoveTag, CanManageLink, CanManageAsset;

    private const INDEXABLE_FILE = "index.html"; 

    private Page $page;

    private string $url;
    
    private string $domain;

    private array $assets;


    public function __construct(Page $page, string $url) {
        $this->page = $page;

        $this->assets = [];

        $this->url = $url;
    }

    public static function replaceRelativePathToAbsolutePath(string $html, string $url): string {
        $pattern = "/(?<attr>src|href)\s*=['\"](?<src>[\w\/._-]+)['\"]/";
        
        return preg_replace_callback($pattern, function($matches) use ($url) {
            $src = $url . $matches["src"];
            $attr = $matches["attr"];
    
            return "{$attr}=\"{$src}\"";
        }, $html);
    }

    public function setDomainFromURL(): void {
        $pattern = "/https?\:\/\/(?<domain>[\w._-]+)\..*/";
    
        preg_match($pattern, $this->url, $matches);

        $domain = $matches["domain"];

        $this->domain = $domain;
    }
}
