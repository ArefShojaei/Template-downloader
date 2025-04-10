<?php

namespace App\Modules\Client;


interface ClientBuilderInterface {
    public function setHttpDomain(): self;
    public function setHttpRequest(): self;
    public function setHtmlContentChanger(): self;
    public function setPageLoader(): self;
    public function build(): Client;
}