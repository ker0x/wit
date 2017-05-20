<?php

namespace Kerox\Wit\Request;

use Kerox\Wit\Helper\UtilityTrait;

class SampleRequest extends AbstractRequest
{

    use UtilityTrait;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var \Kerox\Wit\Model\SampleEntity[]
     */
    protected $entities;

    /**
     * SampleRequest constructor.
     *
     * @param string $accessToken
     * @param string $text
     * @param array|\Kerox\Wit\Model\SampleEntity[] $entities
     */
    public function __construct($accessToken, string $text, array $entities)
    {
        parent::__construct($accessToken);

        $this->text = $text;
        $this->entities = $entities;
    }

    /**
     * @return array
     */
    protected function buildHeaders(): array
    {
        return parent::buildHeaders();
    }

    /**
     * @return array
     */
    protected function buildBody(): array
    {
        $body = [
            'text' => $this->text,
            'entities' => $this->entities,
        ];

        return $this->arrayFilter($body);
    }

    /**
     * @return null
     */
    protected function buildQuery()
    {
        return;
    }
}
