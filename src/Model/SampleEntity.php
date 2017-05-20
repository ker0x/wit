<?php

namespace Kerox\Wit\Model;

class SampleEntity implements \JsonSerializable
{

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var null|string
     */
    protected $value;

    /**
     * @var null|int
     */
    protected $start;

    /**
     * @var null|int
     */
    protected $end;

    /**
     * SampleEntity constructor.
     *
     * @param string $entity
     */
    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param null|string $value
     * @return SampleEntity
     */
    public function setValue(string $value): SampleEntity
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param int|null $start
     * @return SampleEntity
     */
    public function setStart(int $start): SampleEntity
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @param int|null $end
     * @return SampleEntity
     */
    public function setEnd(int $end): SampleEntity
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $json = [
            'entity' => $this->entity,
            'value' => $this->value,
            'start' => $this->start,
            'end' => $this->end,
        ];

        return array_filter($json);
    }
}
