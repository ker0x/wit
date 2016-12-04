<?php
namespace Kerox\Wit\Model\Entity;

class Value implements \JsonSerializable
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $expressions = [];

    /**
     * @var string
     */
    protected $metadata;

    /**
     * Value constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param array $expressions
     * @return \Kerox\Wit\Model\Entity\Value
     */
    public function setExpressions(array $expressions): Value
    {
        $this->expressions = $expressions;

        return $this;
    }

    /**
     * @param string $expression
     * @return \Kerox\Wit\Model\Entity\Value
     */
    public function addExpression(string $expression): Value
    {
        $this->expressions[] = $expression;

        return $this;
    }

    /**
     * @param string $metadata
     * @return \Kerox\Wit\Model\Entity\Value
     */
    public function setMetadata(string $metadata): Value
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $json = [
            'value' => $this->value,
            'expressions' => $this->expressions,
            'metadata' => $this->metadata,
        ];

        return array_filter($json);
    }
}
