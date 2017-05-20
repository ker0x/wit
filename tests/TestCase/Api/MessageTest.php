<?php
namespace Kerox\Wit\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Wit\Api\Message;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class MessageTest extends AbstractTestCase
{

    /**
     * @var \Kerox\Wit\Api\Message
     */
    protected $messageApi;

    public function setUp()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/message.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler
        ]);

        $this->messageApi = new Message('1234abcd', $client);
    }

    public function testGetMessage()
    {
        $response = $this->messageApi->get('hello world');

        $this->assertEquals('742eca38-ca71-4c03-8cdd-e96a9905a3d2', $response->getMessageId());
        $this->assertEquals('hello world', $response->getText());
        $this->assertTrue($response->hasEntity('contact'));
        $this->assertEquals(['contact'=>[['confidence' => 0.9855819413162246,'type'=>'value','value'=>'hello','suggested'=>true],['confidence' => 0.9744819413162246,'type'=>'value','value'=>'world','suggested'=>true]],'intent'=>[['confidence'=>0.9744819413162246,'value'=>'greeting']]], $response->getEntities());
        $this->assertEquals([['confidence' => 0.9855819413162246,'type'=>'value','value'=>'hello','suggested'=>true],['confidence' => 0.9744819413162246,'type'=>'value','value'=>'world','suggested'=>true]], $response->getEntity('contact'));
        $this->assertEquals(2, $response->countEntities());
        $this->assertEquals(['hello','world'], $response->getValuesForEntity('contact'));
        $this->assertEquals('hello', $response->getFirstValueForEntity('contact'));
    }

    public function tearDown()
    {
        unset($this->messageApi);
    }
}