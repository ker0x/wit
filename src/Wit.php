<?php
namespace Kerox\Wit;

use GuzzleHttp\Client;
use Kerox\Wit\Api\Converse;
use Kerox\Wit\Api\Entities;
use Kerox\Wit\Api\Message;
use Kerox\Wit\Api\Speech;

class Wit
{

    const API_URL = 'https://api.wit.ai';
    const API_VERSION = '20160526';

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
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->client = new Client([
            'base_uri' => self::API_URL,
        ]);
    }

    /**
     * @return \Kerox\Wit\Api\Message
     */
    public function message(): Message
    {
        $this->getApiInstance('Message');
    }

    /**
     * @return \Kerox\Wit\Api\Speech
     */
    public function speech(): Speech
    {
        $this->getApiInstance('Speech');
    }

    /**
     * @return \Kerox\Wit\Api\Converse
     */
    public function converse(): Converse
    {
        $this->getApiInstance('Converse');
    }

    /**
     * @return \Kerox\Wit\Api\Entities
     */
    public function entities(): Entities
    {
        $this->getApiInstance('Entities');
    }

    /**
     * @param string $className
     * @return mixed
     */
    private function getApiInstance(string $className)
    {
        $class = __NAMESPACE__ . '\\Api\\' . $className;
        return new $class($this->accessToken, $this->client);
    }
}
