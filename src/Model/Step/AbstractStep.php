<?php
namespace Kerox\Wit\Model\Step;

abstract class AbstractStep
{

    const TYPE_MERGE = 'merge';
    const TYPE_ACTION = 'action';
    const TYPE_MESSAGE = 'msg';
    const TYPE_STOP = 'stop';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var float
     */
    protected $confidence;

    /**
     * AbstractStep constructor.
     *
     * @param string $type
     * @param float $confidence
     */
    public function __construct(string $type, float $confidence)
    {
        $this->type = $type;
        $this->confidence = $confidence;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getConfidence(): float
    {
        return $this->confidence;
    }
}
