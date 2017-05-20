<?php

namespace Kerox\Wit;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Kerox\Wit\Api\App;
use Kerox\Wit\Api\Converse;
use Kerox\Wit\Api\Entities;
use Kerox\Wit\Api\Message;
use Kerox\Wit\Api\Sample;

class Wit
{

    const API_URL = 'https://api.wit.ai';
    const API_VERSION = '20170307';

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Wit constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(string $accessToken, ClientInterface $client = null)
    {
        $this->accessToken = $accessToken;

        if ($client === null) {
            $client = new Client([
                'base_uri' => self::API_URL . '/',
            ]);
        }
        $this->client = $client;
    }

    /**
     * @return \Kerox\Wit\Api\Message
     */
    public function message(): Message
    {
        return Message::getInstance($this->accessToken, $this->client);
    }

    /**
     * @return \Kerox\Wit\Api\Converse
     */
    public function converse(): Converse
    {
        return Converse::getInstance($this->accessToken, $this->client);
    }

    /**
     * @return \Kerox\Wit\Api\Entities
     */
    public function entities(): Entities
    {
        return Entities::getInstance($this->accessToken, $this->client);
    }

    /**
     * @return \Kerox\Wit\Api\Sample
     */
    public function sample(): Sample
    {
        return Sample::getInstance($this->accessToken, $this->client);
    }

    /**
     * @return \Kerox\Wit\Api\App
     */
    public function app(): App
    {
        return App::getInstance($this->accessToken, $this->client);
    }
}
