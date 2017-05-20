<?php

namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;
use Kerox\Wit\Request\MessageRequest;
use Kerox\Wit\Response\MessageResponse;

class Message extends AbstractApi
{

    /**
     * @var null|\Kerox\Wit\Api\Message
     */
    private static $_instance;

    /**
     * Message constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(string $accessToken, ClientInterface $client)
    {
        parent::__construct($accessToken, $client);
    }

    /**
     * @param string $accessToken
     * @param \GuzzleHttp\ClientInterface $client
     * @return \Kerox\Wit\Api\Message
     */
    public static function getInstance(string $accessToken, ClientInterface $client)
    {
        if (self::$_instance === null) {
            self::$_instance = new Message($accessToken, $client);
        }

        return self::$_instance;
    }

    /**
     * @param string $message
     * @param string|null $messageId
     * @param string|null $threadId
     * @return \Kerox\Wit\Response\MessageResponse
     */
    public function get(string $message, string $messageId = null, string $threadId = null, int $traitNumber = 1)
    {
        $this->isValidMessage($message);
        $this->isValidTraitNumber($traitNumber);

        $request = new MessageRequest($this->accessToken, $message, $messageId, $threadId, $traitNumber);
        $response = $this->client->get('message', $request->build());

        return new MessageResponse($response);
    }

    /**
     * @param string $message
     * @throws /\InvalidArgumentException
     */
    private function isValidMessage(string $message)
    {
        $messageLength = mb_strlen($message);
        if (empty($message) || $messageLength > 256) {
            throw new \InvalidArgumentException('$message length must be > 0 and < 256. Current length is ' . $messageLength);
        }
    }

    /**
     * @param int $traitNumber
     * @throws /\InvalidArgumentException
     */
    private function isValidTraitNumber(int $traitNumber)
    {
        if ($traitNumber < 1 || $traitNumber > 8) {
            throw new \InvalidArgumentException('$traitNumber must be between 1 and 8.');
        }
    }
}
