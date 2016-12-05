<?php
namespace Kerox\Wit\Model;

class Context implements \JsonSerializable
{

    /**
     * @var array
     */
    protected $data;

    /**
     * Context constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function add(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $name, $default = null)
    {
        return $this->data[$name] ?? $default;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @param string $name
     */
    public function remove(string $name)
    {
        unset($this->data[$name]);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * @param \DateTimeInterface $dateTime
     */
    public function setReferenceTime(\DateTimeInterface $dateTime)
    {
        $this->add('reference_time', $dateTime->format(DATE_ISO8601));
    }

    /**
     * @return string
     */
    public function getReferenceTime(): string
    {
        return $this->get('reference_time');
    }

    /**
     * @param $timezone
     */
    public function setTimezone($timezone)
    {
        $this->add('timezone', (new \DateTimeZone($timezone))->getName());
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->get('timezone');
    }

    /**
     * @return array
     */
    public function getState(): array
    {
        return $this->get('state', []);
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->get('entities', []);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
