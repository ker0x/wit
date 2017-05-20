<?php

namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class SampleResponse extends AbstractResponse
{

    const SENT = 'sent';
    const TOTAL = 'n';

    /**
     * @var
     */
    protected $isSent = false;

    /**
     * @var
     */
    protected $total = 0;

    /**
     * SampleResponse constructor.
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
            $this->setSent($response);
            $this->setTotal($response);
        }
    }

    /**
     * @return bool
     */
    public function isSent(): bool
    {
        return $this->isSent;
    }

    /**
     * @param array $response
     */
    public function setSent(array $response)
    {
        if (isset($response[self::SENT])) {
            $this->isSent = $response[self::SENT];
        }
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param array $response
     */
    public function setTotal(array $response)
    {
        if (isset($response[self::TOTAL])) {
            $this->total = $response[self::TOTAL];
        }
    }
}
