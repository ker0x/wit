<?php

namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;
use Kerox\Wit\Request\SampleRequest;
use Kerox\Wit\Response\SampleResponse;

class Sample extends AbstractApi
{

    /**
     * @var null|\Kerox\Wit\Api\Sample
     */
    private static $_instance;

    /**
     * Sample constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(string $accessToken, ClientInterface $client)
    {
        parent::__construct($accessToken, $client);
    }

    /**
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     * @return \Kerox\Wit\Api\Sample
     */
    public static function getInstance(string $accessToken, ClientInterface $client): Sample
    {
        if (self::$_instance === null) {
            self::$_instance = new Sample($accessToken, $client);
        }

        return self::$_instance;
    }

    /**
     * @param string $text
     * @param \Kerox\Wit\Model\SampleEntity[] $entities
     * @return \Kerox\Wit\Response\SampleResponse
     */
    public function post(string $text, array $entities): SampleResponse
    {
        $request = new SampleRequest($this->accessToken, $text, $entities);
        $response = $this->client->post('sample', $request->build());

        return new SampleResponse($response);
    }
}
