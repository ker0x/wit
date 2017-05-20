<?php

namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class AppResponse extends AbstractResponse
{

    const ACCESS_TOKEN = 'access_token';
    const APP_ID = 'app_id';
    const SUCCESS = 'success';

    /**
     * @var null|string
     */
    protected $accessToken;

    /**
     * @var null|string
     */
    protected $appId;

    /**
     * @var null|bool
     */
    protected $success;

    /**
     * AppResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @param array $response
     * @return void
     */
    public function parseResponse(array $response)
    {
        if (!$this->hasError($response)) {
            $this->setAccessToken($response);
            $this->setAppId($response);
            $this->setSuccess($response);
        }
    }

    /**
     * @return null|string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param array $response
     */
    public function setAccessToken(array $response)
    {
        if (isset($response[self::ACCESS_TOKEN])) {
            $this->accessToken = $response[self::ACCESS_TOKEN];
        }
    }

    /**
     * @return null|string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param array $response
     */
    public function setAppId(array $response)
    {
        if (isset($response[self::APP_ID])) {
            $this->appId = $response[self::APP_ID];
        }
    }

    /**
     * @return bool|null
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param array $response
     */
    public function setSuccess(array $response)
    {
        if (isset($response[self::SUCCESS])) {
            $this->success = (bool)$response[self::SUCCESS];
        }
    }
}
