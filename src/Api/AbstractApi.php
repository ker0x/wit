<?php
namespace Kerox\Wit\Api;

use GuzzleHttp\Client;

abstract class AbstractApi
{

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var Client
     */
    protected $client;

    /**
     * AbstractApi constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $accessToken, Client $client)
    {
        $this->accessToken = $accessToken;
        $this->client = $client;
    }
}