<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class ConectorApi
{
    private $httpClient;
    public function __construct(){
        $this->httpClient = HttpClient::create();
    }

    public function getData($url){
        $response = $this->httpClient->request('GET', $url);

        if (200 !== $response->getStatusCode()) {
            return false;
        } else {
            $content = $response->getContent();

            $content = $response->toArray();

            return $content;
        }
    }
}