<?php
namespace Kerox\Wit\Model\Step;

class Merge extends AbstractStep
{

    /**
     * @var array
     */
    protected $entities;

    /**
     * Merge constructor.
     *
     * @param float $confidence
     * @param array $entities
     */
    public function __construct(float $confidence, array $entities)
    {
        parent::__construct(self::TYPE_MERGE, $confidence);

        $this->entities = $entities;
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
