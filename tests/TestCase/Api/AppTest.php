<?php
namespace Kerox\Wit\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Wit\Api\App;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class AppTest extends AbstractTestCase
{

    public function testCreateApp()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/create_app.json');
        $appApi = $this->buildApiWithResponse($bodyResponse);

        $response = $appApi->add('My_New_App', 'en', false);

        $this->assertEquals('NEW_ACCESS_TOKEN', $response->getAccessToken());
        $this->assertEquals('NEW_APP_ID', $response->getAppId());
    }

    public function testUpdateApp()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/update_app.json');
        $appApi = $this->buildApiWithResponse($bodyResponse);

        $response = $appApi->update('57f57a8a-a7ac-4e59-ac07-67d46422bb12', null, 'fr', null, 'Europe/Paris');

        $this->assertTrue($response->getSuccess());
    }

    private function buildApiWithResponse($bodyResponse)
    {
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler,
        ]);

        return new App('1234abcd', $client);
    }
}