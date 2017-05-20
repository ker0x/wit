<?php

namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;
use Kerox\Wit\Request\AppRequest;
use Kerox\Wit\Response\AppResponse;

class App extends AbstractApi
{

    /**
     * @var null|\Kerox\Wit\Api\App
     */
    private static $_instance;

    /**
     * App constructor.
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
     * @return \Kerox\Wit\Api\App
     */
    public static function getInstance(string $accessToken, ClientInterface $client): App
    {
        if (self::$_instance === null) {
            self::$_instance = new App($accessToken, $client);
        }

        return self::$_instance;
    }

    /**
     * @param string $name
     * @param string $lang
     * @param bool $private
     * @param string|null $description
     * @return \Kerox\Wit\Response\AppResponse
     */
    public function add(string $name, string $lang, bool $private = true, string $description = null): AppResponse
    {
        $request = new AppRequest($this->accessToken, $name, $lang, $private, $description);
        $response = $this->client->post('apps', $request->build());

        return new AppResponse($response);
    }

    /**
     * @param string $id
     * @param null|string $name
     * @param null|string $lang
     * @param null|bool $private
     * @param null|string $timezone
     * @param null|string $description
     * @return \Kerox\Wit\Response\AppResponse
     */
    public function update(string $id, $name = null, $lang = null, $private = null, $timezone = null, $description = null): AppResponse
    {
        $request = new AppRequest($this->accessToken, $name, $lang, $private, $description, $timezone);
        $response = $this->client->put('apps/' . $id, $request->build());

        return new AppResponse($response);
    }
}
