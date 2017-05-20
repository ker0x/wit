<?php

namespace Kerox\Wit\Request;

use Kerox\Wit\Wit;

abstract class AbstractRequest
{

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * AbstractRequest constructor.
     *
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    protected function buildHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Accept' => 'application/vnd.wit.' . Wit::API_VERSION . '+json'
        ];
    }

    /**
     * @return mixed
     */
    abstract protected function buildBody();

    /**
     * @return mixed
     */
    abstract protected function buildQuery();

    /**
     * @return array
     */
    public function build(): array
    {
        $request = [
            'headers' => $this->buildHeaders(),
            'json' => $this->buildBody(),
            'query' => $this->buildQuery(),
        ];

        return array_filter($request);
    }
}
