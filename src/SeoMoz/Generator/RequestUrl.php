<?php

namespace SeoMoz\Generator;

/**
 * Class RequestUrl
 * @package SeoMoz\Generator
 * @author Jon Gotlin
 * @author David Wickström
 */
class RequestUrl
{
    /**
     * @var
     */
    private $accessId;
    /**
     * @var
     */
    private $secretKey;

    /**
     * @param $accessId
     * @param $secretKey
     */
    public function __construct($accessId, $secretKey)
    {
        $this->accessId = $accessId;
        $this->secretKey = $secretKey;
    }

    /**
     * @param $domainName
     * @return string
     */
    public function generate($domainName)
    {
        $expires = time() + 300;
        $urlSafeSignature = $this->buildSafeSignatureUrl($expires);
        $cols = 34359738368 + 68719476736 + 536870912 + 32;

        return $this->buildUrl($domainName, $cols, $expires, $urlSafeSignature);
    }

    /**
     * @param $domainName
     * @param $cols
     * @param $expires
     * @param $urlSafeSignature
     * @return string
     */
    private function buildUrl($domainName, $cols, $expires, $urlSafeSignature)
    {
        $parts = [
            'http://lsapi.seomoz.com/linkscape/url-metrics/',
            urlencode($domainName),
            "?Cols=".$cols."&AccessID=".$this->accessId."&Expires=".$expires."&Signature=".$urlSafeSignature
        ];

        return implode("", $parts);
    }

    /**
     * @param $expires
     * @return string
     */
    private function buildSafeSignatureUrl($expires)
    {
        $stringToSign = $this->accessId . "\n" . $expires;
        $binarySignature = hash_hmac('sha1', $stringToSign, $this->secretKey, true);
        $urlSafeSignature = urlencode(base64_encode($binarySignature));

        return $urlSafeSignature;
    }
}
