<?php

namespace SeoMoz;

use SeoMoz\Client\Client;
use SeoMoz\Generator\RequestUrl;
use SeoMoz\Validator\ResponseValidator;

class Request
{

    /**
     * @var Generator\RequestUrl
     */
    private $requestUrlGenerator;
    /**
     * @var Client\Client
     */
    private $client;
    /**
     * @var Validator\ResponseValidator
     */
    private $requestValidator;

    /**
     * @param RequestUrl $requestUrlGenerator
     * @param Client $client
     * @param ResponseValidator $requestValidator
     */
    public function __construct(
        RequestUrl $requestUrlGenerator,
        Client $client,
        ResponseValidator $requestValidator
    ) {
        $this->requestUrlGenerator = $requestUrlGenerator;
        $this->client = $client;
        $this->requestValidator = $requestValidator;
    }

    /**
     * @param $domainName
     * @return Response
     */
    public function make($domainName)
    {
        $url = $this->requestUrlGenerator->generate($domainName);
        $response = $this->client->get($url);
        $this->requestValidator->validate($response);

        return $this->respond($response);
    }

    /**
     * @param $response
     * @return Response
     */
    private function respond($response)
    {
        return new Response(
            json_decode($response->getBody()->__toString())
        );
    }
}
