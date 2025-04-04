<?php

namespace App\Modules\Client;

use App\Modules\Client\ClientBuilderInterface;


/**
 * TODO: Complete ClientBuilder task. 
 */
final class ClientBuilder implements ClientBuilderInterface {
    public function setHttpRequest() {}
    
    public function setDomainOfUrl() {}
    
    public function setHtmlLoader() {}
    
    public function setHtmlContentChanger() {}
    
    public function setFileDownloader() {}
    
    public function build() {}
}