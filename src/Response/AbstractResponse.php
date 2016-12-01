<?php
namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse
{

    const ERROR = 'error';
    const ERROR_CODE = 'code';

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @var null|string
     */
    protected $error;

    /**
     * @var null|string
     */
    protected $errorCode;

    /**
     * AbstractResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        $this->parseResponse($this->decodeResponse($response));
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array
     */
    private function decodeResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * @param array $response
     * @return mixed
     */
    abstract protected function parseResponse(array $response);

    /**
     * @param array $response
     * @return bool
     */
    protected function hasError(array $response): bool
    {
        if (isset($response[self::ERROR])) {
            $this->error = $response[self::ERROR];
            $this->errorCode = $response[self::ERROR_CODE];

            return true;
        }

        return false;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
