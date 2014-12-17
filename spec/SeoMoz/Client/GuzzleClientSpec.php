<?php

namespace spec\SeoMoz\Client;

use GuzzleHttp\ClientInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GuzzleClientSpec extends ObjectBehavior
{
    function let(ClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }

    function it_can_request_data_from_seomoz(ClientInterface $guzzle)
    {
        $guzzle->get(Argument::any())->willReturn('bar');
        $this->get('http://foo.bar/baz.html')->shouldReturn('bar');
    }

    function it_only_accepts_strings_as_argument()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringGet(1.1);
    }

    function it_craves_a_valid_url_too()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringGet('http::/foo/');
    }
}
