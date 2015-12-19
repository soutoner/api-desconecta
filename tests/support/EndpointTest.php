<?php


class EndpointTest
{
    /**
     * API version of the endpoint;
     *
     * @var string
     */
    protected $version;

    /**
     * Enpoint name.
     *
     * @var string
     */
    protected $endpoint;

    public function __construct($dir = __DIR__, $file = __FILE__)
    {
        $this->version = basename(dirname($dir));
        $this->endpoint = '/api/' . $this->version . '/' . basename(dirname($file));
    }
}
