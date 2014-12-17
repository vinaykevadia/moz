<?php

namespace SeoMoz\Validator;


use SeoMoz\Exception\BadCredentialsException;
use SeoMoz\Exception\InvalidSeoMozFormatException;

class ResponseValidator
{
    public function validate($response)
    {
        if ($this->isEmpty($response)) {
            throw new InvalidSeoMozFormatException('Empty result');
        }

        $json = json_decode($response);

        if (isset($json->status)) {
            if ("200" != $json->status) {
                throw new BadCredentialsException($json->error_message);
            }
        }
    }

    /**
     * @param $response
     * @return bool
     */
    private function isEmpty($response)
    {
        return empty($response) || '{}' == $response;
    }
} 