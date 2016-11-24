<?php
namespace Kerox\Wit\Api;

use GuzzleHttp\Client;
use Kerox\Wit\Request\MessageRequest;
use Kerox\Wit\Response\MessageResponse;

class Message extends AbstractApi
{

    /**
     * Message constructor.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $accessToken, Client $client)
    {
        parent::__construct($accessToken, $client);
    }

    /**
     * @param string $message
     * @param string|null $messageId
     * @param string|null $threadId
     * @return \Kerox\Wit\Response\MessageResponse
     */
    public function get(string $message, string $messageId = null, string $threadId = null)
    {
        $this->isValidMessage($message);

        $request = new MessageRequest($this->accessToken, $message, $messageId, $threadId);
        $response = $this->client->get('/message', $request->build());

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
}