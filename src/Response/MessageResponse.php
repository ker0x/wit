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
     * @var array
     */
    protected $entities = [];

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
        return count($this->entities);
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
        return isset($this->entities[$entityName]);
    }

    /**
     * @param string $entityName
     * @return array
     */
    public function getEntity(string $entityName)
    {
        return $this->entities[$entityName];
    }
}
