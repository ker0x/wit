<?php
namespace Kerox\Wit\Api;

use GuzzleHttp\Client;

class Converse extends AbstractApi
{

    public function __construct(string $accessToken, Client $client)
    {
        parent::__construct($accessToken, $client);
    }
}