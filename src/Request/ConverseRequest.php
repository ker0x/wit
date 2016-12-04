<?php
namespace Kerox\Wit\Request;

class ConverseRequest extends AbstractRequest
{

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * @var null|string
     */
    protected $text;

    /**
     * @var null|\Kerox\Wit\Model\Context
     */
    protected $context;

    /**
     * ConverseRequest constructor.
     *
     * @param string $accessToken
     * @param string $sessionId
     * @param null|string $text
     * @param null|\Kerox\Wit\Model\Context $context
     */
    public function __construct(string $accessToken, string $sessionId, $text, $context)
    {
        parent::__construct($accessToken);

        $this->sessionId = $sessionId;
        $this->text = $text;
        $this->context = $context;
    }

    /**
     * @return array
     */
    protected function buildHeaders(): array
    {
        return parent::buildHeaders();
    }

    /**
     * @return null|\Kerox\Wit\Model\Context
     */
    protected function buildBody()
    {
        return $this->context;
    }

    /**
     * @return array
     */
    protected function buildQuery(): array
    {
        $query = [
            'session_id' => $this->sessionId,
            'q' => $this->text,
        ];

        return array_filter($query);
    }
}