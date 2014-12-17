<?php

namespace spec\SeoMoz\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseValidatorSpec extends ObjectBehavior
{
    function it_takes_exception_to_empty_api_responses()
    {
        $dummy = '{}';
        $this->shouldThrow('SeoMoz\Exception\InvalidSeoMozFormatException')
             ->duringValidate($dummy);

        $dummy = '';
        $this->shouldThrow('SeoMoz\Exception\InvalidSeoMozFormatException')
            ->duringValidate($dummy);
    }

    function it_takes_exception_to_bad_credentials()
    {
        $dummy = '{"status": "foo", "error_message": "bar"}';
        $this->shouldThrow('SeoMoz\Exception\BadCredentialsException')
            ->duringValidate($dummy);
    }
}
