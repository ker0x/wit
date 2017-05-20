<?php

namespace Kerox\Wit\Model;

use Kerox\Wit\Model\Entity\Value;

class Entity implements \JsonSerializable
{

    const LOOKUP_TRAIT = 'trait';
    const LOOKUP_KEYWORDS = 'keywords';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var null|string
     */
    protected $doc;

    /**
     * @var \Kerox\Wit\Model\Entity\Value[]
     */
    protected $values = [];

    /**
     * @var array
     */
    protected $lookups = [];

    /**
     * Entity constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param null|string $doc
     * @return Entity
     */
    public function setDoc($doc): Entity
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * @param \Kerox\Wit\Model\Entity\Value[] $values
     * @return Entity
     */
    public function setValues(array $values): Entity
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param \Kerox\Wit\Model\Entity\Value $value
     * @return \Kerox\Wit\Model\Entity
     */
    public function addValue(Value $value): Entity
    {
        $this->values[] = $value;

        return $this;
    }

    /**
     * @param array $lookups
     * @return Entity
     */
    public function setLookups(array $lookups): Entity
    {
        foreach ($lookups as $lookup) {
            $this->isValidLookup($lookup);
        }
        $this->lookups = $lookups;

        return $this;
    }

    /**
     * @param string $lookup
     * @return \Kerox\Wit\Model\Entity
     */
    public function addLookup(string $lookup): Entity
    {
        $this->isValidLookup($lookup);
        $this->lookups[] = $lookup;

        return $this;
    }

    /**
     * @param string $lookup
     */
    private function isValidLookup(string $lookup)
    {
        $allowedLookups = $this->getAllowedLookups();
        if (!in_array($lookup, $allowedLookups)) {
            throw new \InvalidArgumentException('$lookup must be either ' . implode(', ', $allowedLookups));
        }
    }

    /**
     * @return array
     */
    private function getAllowedLookups(): array
    {
        return [
            self::LOOKUP_KEYWORDS,
            self::LOOKUP_TRAIT,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $json = [
            'id' => $this->id,
            'doc' => $this->doc,
            'values' => $this->values,
            'lookups' => $this->lookups,
        ];

        return array_filter($json);
    }
}
