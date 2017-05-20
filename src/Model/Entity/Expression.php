<?php

namespace Kerox\Wit\Model\Entity;

class Expression implements \JsonSerializable
{

    /**
     * @var string
     */
    protected $expression;

    /**
     * Expression constructor.
     *
     * @param string $expression
     */
    public function __construct(string $expression)
    {
        $this->isValidExpression($expression);
        $this->expression = $expression;
    }

    /**
     * @param $expression
     */
    private function isValidExpression($expression)
    {
        $expressionLength = mb_strlen($expression);
        if (empty($expression) || $expressionLength > 256) {
            throw new \InvalidArgumentException('$message length must be > 0 and < 256. Current length is ' . $expressionLength);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'expression' => $this->expression
        ];
    }
}
