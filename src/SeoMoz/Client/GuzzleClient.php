<?php

namespace SeoMoz\Client;

use GuzzleHttp\ClientInterface;

class GuzzleClient implements Client
{

    /**
     * @var ClientInterface
     */
    private $guzzle;

    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function get($url)
    {
        if (!$this->isValidArgument($url)) {
            throw new \InvalidArgumentException('Supply a valid URL please.');
        }
        return $this->guzzle->request("GET", $url);
    }

    /**
     * @param $url
     * @return bool
     */
    private function isValidArgument($url)
    {
        return is_string($url) and filter_var($url, FILTER_VALIDATE_URL);
    }
}
