<?php
namespace Kerox\Wit\Response;

use Psr\Http\Message\ResponseInterface;

class SpeechResponse extends MessageResponse
{

    /**
     * SpeechResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }
}
