<?php
namespace Kerox\Wit\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Wit\Api\Sample;
use Kerox\Wit\Model\SampleEntity;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class SampleTest extends AbstractTestCase
{

    /**
     * @var \Kerox\Wit\Api\Sample
     */
    protected $sampleApi;

    public function setUp()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/sample.json');
        $mockedResponse = new MockHandler([
            new Response(200, [], $bodyResponse),
        ]);

        $handler = HandlerStack::create($mockedResponse);
        $client = new Client([
            'handler' => $handler
        ]);

        $this->sampleApi = new Sample('1234abcd', $client);
    }

    public function testPostSample()
    {
        $sampleEntity = new SampleEntity('wit$location');
        $sampleEntity
            ->setValue('flight_request')
            ->setStart(17)
            ->setEnd(20);

        $response = $this->sampleApi->post('I want to fly to sfo', [$sampleEntity]);

        $this->assertTrue($response->isSent());
        $this->assertEquals(1, $response->getTotal());
    }

    public function tearDown()
    {
        unset($this->sampleApi);
    }
}