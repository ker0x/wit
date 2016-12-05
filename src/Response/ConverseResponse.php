<?php
namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class ConverseResponse extends AbstractResponse
{

    const TYPE = 'type';
    const MESSAGE = 'msg';
    const QUICK_REPLIES = 'quickreplies';
    const ACTION = 'action';
    const ENTITIES = 'entities';
    const CONFIDENCE = 'confidence';

    const TYPE_MERGE = 'merge';
    const TYPE_MESSAGE = 'msg';
    const TYPE_ACTION = 'action';
    const TYPE_STOP = 'stop';

    /**
     * @var null|string
     */
    protected $type;

    /**
     * @var null|string
     */
    protected $message;

    /**
     * @var null|array
     */
    protected $quickReplies;

    /**
     * @var null|string
     */
    protected $action;

    /**
     * @var null|array
     */
    protected $entities;

    /**
     * @var null|float
     */
    protected $confidence;

    /**
     * ConverseResponse constructor.
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
    public function parseResponse(array $response)
    {
        if (!$this->hasError($response)) {
            $this->setType($response);
            $this->setMessage($response);
            $this->setQuickReplies($response);
            $this->setAction($response);
            $this->setEntities($response);
            $this->setConfidence($response);
        }
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $response
     * @return void
     */
    public function setType(array $response)
    {
        if (isset($response[self::TYPE])) {
            $this->type = $response[self::TYPE];
        }
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param array $response
     * @return void
     */
    public function setMessage(array $response)
    {
        if (isset($response[self::MESSAGE])) {
            $this->message = $response[self::MESSAGE];
        }
    }

    /**
     * @return array|null
     */
    public function getQuickReplies()
    {
        return $this->quickReplies;
    }

    /**
     * @param array $response
     */
    public function setQuickReplies(array $response)
    {
        if (isset($response[self::QUICK_REPLIES])) {
            $this->quickReplies = $response[self::QUICK_REPLIES];
        }
    }

    /**
     * @return bool
     */
    public function hasQuickReplies(): bool
    {
        return !empty($this->quickReplies);
    }

    /**
     * @return null|string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param array $response
     */
    public function setAction(array $response)
    {
        if (isset($response[self::ACTION])) {
            $this->action = $response[self::ACTION];
        }
    }

    /**
     * @return array|null
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param array $response
     */
    public function setEntities(array $response)
    {
        if (isset($response[self::ENTITIES])) {
            $this->entities = $response[self::ENTITIES];
        }
    }

    /**
     * @param string $entity
     * @return mixed|null
     */
    public function getEntity(string $entity)
    {
        if ($this->hasEntity($entity)) {
            return $this->entities[$entity];
        }

        return null;
    }

    /**
     * @param string $entity
     * @return bool
     */
    public function hasEntity(string $entity): bool
    {
        $entities = $this->getEntities();
        if ($entities !== null) {
            return array_key_exists($entity, $entities);
        }

        return false;
    }

    /**
     * @return float|null
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     * @param array $response
     */
    public function setConfidence(array $response)
    {
        if (isset($response[self::CONFIDENCE])) {
            $this->confidence = $response[self::CONFIDENCE];
        }
    }

    /**
     * @return bool
     */
    public function isStop(): bool
    {
        return $this->type === self::TYPE_STOP;
    }
}
