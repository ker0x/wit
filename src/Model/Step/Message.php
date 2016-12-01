<?php
namespace Kerox\Wit\Model\Step;

class Message extends AbstractStep
{

    /**
     * @var string
     */
    protected $message;

    /**
     * Message constructor.
     *
     * @param float $confidence
     * @param string $message
     */
    public function __construct(float $confidence, string $message)
    {
        parent::__construct(self::TYPE_MESSAGE, $confidence);

        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}