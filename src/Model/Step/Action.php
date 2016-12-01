<?php
namespace Kerox\Wit\Model\Step;

class Action extends AbstractStep
{

    /**
     * @var string
     */
    protected $action;

    /**
     * Action constructor.
     *
     * @param float $confidence
     * @param string $action
     */
    public function __construct(float $confidence, string $action)
    {
        parent::__construct(self::TYPE_ACTION, $confidence);

        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}
