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
     * @var \Kerox\Wit\Api\Message
     */
    protected $messageApi;

    /**
     * @var \Kerox\Wit\Api\Speech
     */
    protected $speechApi;

    /**
     * @var \Kerox\Wit\Api\Converse
     */
    protected $converseApi;

    /**
     * @var \Kerox\Wit\Api\Entities
     */
    protected $entitiesApi;

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
        if ($this->messageApi === null) {
            $this->messageApi = $this->getApiInstance('Message');
        }

        return $this->messageApi;
    }

    /**
     * @return \Kerox\Wit\Api\Speech
     */
    public function speech(): Speech
    {
        if ($this->speechApi === null) {
            $this->speechApi = $this->getApiInstance('Speech');
        }

        return $this->speechApi;
    }

    /**
     * @return \Kerox\Wit\Api\Converse
     */
    public function converse(): Converse
    {
        if ($this->converseApi === null) {
            $this->converseApi = $this->getApiInstance('Converse');;
        }

        return $this->converseApi;
    }

    /**
     * @return \Kerox\Wit\Api\Entities
     */
    public function entities(): Entities
    {
        if ($this->entitiesApi === null) {
            $this->entitiesApi = $this->getApiInstance('Entities');
        }

        return $this->entitiesApi;
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
