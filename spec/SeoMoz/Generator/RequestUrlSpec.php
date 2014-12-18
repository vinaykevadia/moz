<?php

namespace spec\SeoMoz\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestUrlSpec extends ObjectBehavior
{
    function let()
    {
        $accessId = '123456';
        $secretKey = '789101112';
        $this->beConstructedWith($accessId, $secretKey);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SeoMoz\Generator\RequestUrl');
    }

    function it_generates_a_request_url()
    {
        $it = $this->generate('testa.se');
        $it->shouldBeString();
        $it->shouldStartWith('http://lsapi.seomoz.com/linkscape/url-metrics/testa.se');
        $it->shouldEndWith('%3D');
    }
}
