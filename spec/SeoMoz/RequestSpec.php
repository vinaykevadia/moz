<?php

namespace spec\SeoMoz;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SeoMoz\Client\Client;
use SeoMoz\Generator\RequestUrl;
use SeoMoz\Validator\ResponseValidator;

class RequestSpec extends ObjectBehavior
{
    function let(
        RequestUrl $requestUrlGenerator,
        Client $client,
        ResponseValidator $responseValidator
    ) {
        $this->beConstructedWith($requestUrlGenerator, $client, $responseValidator);
    }

    function it_makes_valid_requests_to_the_moz_api(
        RequestUrl $requestUrlGenerator,
        Client $client,
        ResponseValidator $responseValidator,
        GuzzleMock $guzzleMock
    ) {
        $requestUrlGenerator->generate('sunet.se')->shouldBeCalled()->willReturn('foo');
        $dummy = '{"foo": "bar"}';
        $guzzleMock->getBody()->shouldBeCalled()->willReturn($guzzleMock);
        $guzzleMock->__toString()->shouldBeCalled()->willReturn($dummy);
        $client->get('foo')->shouldBeCalled()->willReturn($guzzleMock);
        $responseValidator->validate($dummy)->shouldBeCalled();
        $this->make('sunet.se')->shouldBeAnInstanceOf('SeoMoz\Response');
    }

}

class GuzzleMock
{
    public function getBody()
    {
        return $this;
    }

    public function __toString()
    {
        return 'foo';
    }
}
