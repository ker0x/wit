<?php
namespace Kerox\Wit\Request;

class MessageRequest extends AbstractRequest
{

    /**
     * @var string
     */
    protected $message;

    /**
     * @var null|string
     */
    protected $messageId;

    /**
     * @var null|string
     */
    protected $threadId;

    /**
     * MessageRequest constructor.
     *
     * @param string $accessToken
     * @param string $message
     * @param null|string $messageId
     * @param null|string $threadId
     */
    public function __construct(string $accessToken, string $message, $messageId, $threadId)
    {
        parent::__construct($accessToken);

        $this->message = $message;
        $this->messageId = $messageId;
        $this->threadId = $threadId;
    }

    /**
     * @return array
     */
    protected function buildHeaders(): array
    {
        return parent::buildHeaders();
    }

    /**
     * @return null
     */
    protected function buildBody()
    {
        return;
    }

    /**
     * @return array
     */
    protected function buildQuery(): array
    {
        $query = [
            'q' => $this->message,
            'msg_id' => $this->messageId,
            'thread_id' => $this->threadId,
        ];

        return array_filter($query);
    }
}
