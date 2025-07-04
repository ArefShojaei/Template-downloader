<?php

namespace App\Modules\Client;

use App\Modules\Client\ClientBuilderInterface as IClientBuilder;
use App\Utils\{
    Http\Http,
    URL\URL
};
use Spider\{
    Page,
    Spider
};
use function App\{
    replaceFormActionURLToHashedValue,
    replaceRelativeToAbsoluteLink
};
use Exception;


final class ClientBuilder implements IClientBuilder {
    private string $url;
    
    private string $html;

    private Page $page;

    
    public function __construct(string $url) {
        $this->url = $url;
    }
    
    public function setHttpDomain(): self {
        URL::set($this->url);

        return $this;
    }
    
    public function setHttpRequest(): self {
        $response = Http::get($this->url);

        if ($response["status"] === Http::ERROR) throw new Exception($response["error"]);
    
        $this->html = $response["data"];

        return $this;
    }

    public function setHtmlContentChanger(): self {
        $html = replaceRelativeToAbsoluteLink($this->html, $this->url);

        $this->html = replaceFormActionURLToHashedValue($html);
    
        return $this;
    }

    public function setPageLoader(): self {
        $spider = new Spider;
    
        $this->page = $spider->loadHTML($this->html);

        return $this;
    }

    public function build(): Client {
        return new Client($this->page);
    }
}