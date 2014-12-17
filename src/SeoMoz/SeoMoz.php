<?php

namespace SeoMoz;

use GuzzleHttp\Client;
use SeoMoz\Client\GuzzleClient;
use SeoMoz\Generator\RequestUrl;
use SeoMoz\Validator\ResponseValidator;

class SeoMoz
{

    private $accessId;
    private $secretKey;

    public function __construct($accessId, $secretKey, $request = null)
    {
        $this->accessId = $accessId;
        $this->secretKey = $secretKey;
        $this->request = $request ? : $this->buildRequestInstance();
    }

    public function request($url)
    {
        return $this->request->make($url);
    }

    private function buildRequestInstance()
    {
        return new Request(
            new RequestUrl($this->accessId, $this->secretKey),
            new GuzzleClient(new Client),
            new ResponseValidator
        );
    }
}