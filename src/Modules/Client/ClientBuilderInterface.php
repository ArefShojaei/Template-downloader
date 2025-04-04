<?php

namespace App\Modules\Client;


interface ClientBuilderInterface {
    public function setHttpRequest();
    public function setDomainOfUrl();
    public function setHtmlLoader();
    public function setHtmlContentChanger();
    public function setFileDownloader();
    public function build();
}