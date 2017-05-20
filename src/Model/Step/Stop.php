<?php

namespace Kerox\Wit\Model\Step;

class Stop extends AbstractStep
{

    /**
     * Stop constructor.
     *
     * @param float $confidence
     */
    public function __construct(float $confidence)
    {
        parent::__construct(self::TYPE_STOP, $confidence);
    }
}
