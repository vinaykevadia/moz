<?php

namespace SeoMoz\Client;


interface Client
{
    /**
     * @param $url
     * @return mixed
     */
    public function get($url);
} 