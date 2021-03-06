<?php

namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;
use Kerox\Wit\Model\Entity;
use Kerox\Wit\Model\Entity\Expression;
use Kerox\Wit\Model\Entity\Value;
use Kerox\Wit\Request\EntitiesRequest;
use Kerox\Wit\Response\EntitiesResponse;
use Psr\Http\Message\ResponseInterface;

class Entities extends AbstractApi
{

    /**
     * @var null|\Kerox\Wit\Api\Entities
     */
    private static $_instance;

    /**
     * Entities constructor.
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
     * @return \Kerox\Wit\Api\Entities
     */
    public static function getInstance(string $accessToken, ClientInterface $client)
    {
        if (self::$_instance === null) {
            self::$_instance = new Entities($accessToken, $client);
        }

        return self::$_instance;
    }

    /**
     * @param null|string $entity
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function get(string $entity = null): EntitiesResponse
    {
        if ($entity !== null) {
            $entity  = '/' . $entity;
        }

        $response = $this->client->get(sprintf('entities%s', $entity), $this->request());

        return $this->response($response);
    }

    /**
     * @param \Kerox\Wit\Model\Entity $entity
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function create(Entity $entity): EntitiesResponse
    {
        $request = new EntitiesRequest($this->accessToken, $entity);
        $response = $this->client->post('entities', $request->build());

        return $this->response($response);
    }

    /**
     * @param string $entityId
     * @param \Kerox\Wit\Model\Entity $entity
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function update(string $entityId, Entity $entity): EntitiesResponse
    {
        $response = $this->client->put(sprintf('entities/%s', $entityId), $this->request($entity));

        return $this->response($response);
    }

    /**
     * @param string $entity
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function delete(string $entity): EntitiesResponse
    {
        $response = $this->client->delete(sprintf('entities/%s', $entity), $this->request($entity));

        return $this->response($response);
    }

    /**
     * @param string $entity
     * @param \Kerox\Wit\Model\Entity\Value $value
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function addValue(string $entity, Value $value): EntitiesResponse
    {
        $response = $this->client->post(sprintf('entities/%s/value', $entity), $this->request($value));

        return $this->response($response);
    }

    /**
     * @param string $entity
     * @param string $value
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function deleteValue(string $entity, string $value): EntitiesResponse
    {
        $response = $this->client->delete(sprintf('entities/%s/value/%s', $entity, $value), $this->request());

        return $this->response($response);
    }

    /**
     * @param string $entity
     * @param string $value
     * @param \Kerox\Wit\Model\Entity\Expression $expression
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function addExpression(string $entity, string $value, Expression $expression): EntitiesResponse
    {
        $response = $this->client->post(sprintf('entities/%s/value/%s/expressions', $entity, $value), $this->request($expression));

        return $this->response($response);
    }

    /**
     * @param string $entity
     * @param string $value
     * @param string $expression
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    public function deleteExpression(string $entity, string $value, string $expression): EntitiesResponse
    {
        $response = $this->client->delete(sprintf('entities/%s/value/%s/expressions/%s', $entity, $value, $expression), $this->request());

        return $this->response($response);
    }

    /**
     * @param mixed $body
     * @return array
     */
    private function request($body = null): array
    {
        return (new EntitiesRequest($this->accessToken, $body))->build();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Kerox\Wit\Response\EntitiesResponse
     */
    private function response(ResponseInterface $response): EntitiesResponse
    {
        return new EntitiesResponse($response);
    }
}
