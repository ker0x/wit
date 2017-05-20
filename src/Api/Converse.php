<?php

namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;
use Kerox\Wit\Model\Context;
use Kerox\Wit\Request\ConverseRequest;
use Kerox\Wit\Response\ConverseResponse;

class Converse extends AbstractApi
{

    /**
     * @var null|\Kerox\Wit\Api\Converse
     */
    private static $_instance;

    /**
     * Converse constructor.
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
     * @return \Kerox\Wit\Api\Converse
     */
    public static function getInstance(string $accessToken, ClientInterface $client): Converse
    {
        if (self::$_instance === null) {
            self::$_instance = new Converse($accessToken, $client);
        }

        return self::$_instance;
    }

    /**
     * @param $sessionId
     * @param string|null $text
     * @param \Kerox\Wit\Model\Context|null $context
     * @return \Kerox\Wit\Response\ConverseResponse
     */
    public function converse($sessionId, string $text = null, Context $context = null): ConverseResponse
    {
        $request = new ConverseRequest($this->accessToken, $sessionId, $text, $context);
        $response = $this->client->post('converse', $request->build());

        return new ConverseResponse($response);
    }
}
