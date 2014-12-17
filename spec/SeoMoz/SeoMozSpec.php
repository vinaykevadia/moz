<?php

namespace spec\SeoMoz;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SeoMoz\Request;
use SeoMoz\Response;

class SeoMozSpec extends ObjectBehavior
{
    function let(Request $request)
    {
        $accessId = 'foo';
        $secretKey = 'bar';
        $this->beConstructedWith($accessId, $secretKey, $request);
    }

    function it_builds_a_request_object_and_fires_a_request(Request $request)
    {
        $dummy = new \stdClass();
        $request->make('sunet.se')->shouldBeCalled()->willReturn($dummy);
        $this->request('sunet.se')->shouldHaveType('\stdClass');
    }
}
