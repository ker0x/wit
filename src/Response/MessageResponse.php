<?php
namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class MessageResponse extends AbstractResponse
{

    const MESSAGE_ID = 'msg_id';
    const TEXT = '_text';
    const ENTITIES = 'entities';

    /**
     * @var null|string
     */
    protected $messageId;

    /**
     * @var null|string
     */
    protected $text;

    /**
     * @var null|array
     */
    protected $entities;

    /**
     * MessageResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @param array $response
     * @return void
     */
    protected function parseResponse(array $response)
    {
        if (!$this->hasError($response)) {
            $this->setMessageId($response);
            $this->setText($response);
            $this->setEntities($response);
        }
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param array $response
     */
    private function setMessageId(array $response)
    {
        if (isset($response[self::MESSAGE_ID])) {
            $this->messageId = $response[self::MESSAGE_ID];
        }
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param array $response
     */
    private function setText(array $response)
    {
        if (isset($response[self::TEXT])) {
            $this->text = $response[self::TEXT];
        }
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @return int
     */
    public function countEntities(): int
    {
        return (is_array($this->entities)) ? count($this->entities) : 0;
    }

    /**
     * @param array $response
     */
    private function setEntities(array $response)
    {
        if (isset($response[self::ENTITIES])) {
            $this->entities = $response[self::ENTITIES];
        }
    }

    /**
     * @param string $entityName
     * @return bool
     */
    public function hasEntity(string $entityName): bool
    {
        $entities = $this->getEntities();
        if ($entities !== null) {
            return array_key_exists($entityName, $entities);
        }

        return false;
    }

    /**
     * @param string $entityName
     * @return null|array
     */
    public function getEntity(string $entityName)
    {
        if ($this->hasEntity($entityName)) {
            return $this->entities[$entityName];
        }

        return null;
    }

    /**
     * @param string $entityName
     * @return array|null
     */
    public function getValuesForEntity(string $entityName)
    {
        if ($this->hasEntity($entityName)) {
            return array_column($this->entities[$entityName], 'value');
        }

        return null;
    }

    /**
     * @param string $entityName
     * @return string|null
     */
    public function getFirstValueForEntity(string $entityName)
    {
        if ($this->hasEntity($entityName)) {
            return $this->entities[$entityName][0]['value'];
        }

        return null;
    }
}
