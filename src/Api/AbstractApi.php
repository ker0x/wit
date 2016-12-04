<?php
namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;

abstract class AbstractApi
{

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * AbstractApi constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(string $accessToken, ClientInterface $client)
    {
        $this->accessToken = $accessToken;
        $this->client = $client;
    }
}
