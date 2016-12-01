<?php
namespace Kerox\Wit\Api;

use GuzzleHttp\ClientInterface;

class Converse extends AbstractApi
{

    public function __construct(string $accessToken, ClientInterface $client)
    {
        parent::__construct($accessToken, $client);
    }
}
