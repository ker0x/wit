<?php
namespace Kerox\Wit\Test\TestCase\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Kerox\Wit\Api\Entities;
use Kerox\Wit\Model\Entity;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class EntitiesTest extends AbstractTestCase
{

    public function testGetEntities()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/get_entities.json');
        $entitiesApi = $this->buildApiWithResponse($bodyResponse);

        $response = $entitiesApi->get();

        $this->assertEquals([
            'wit$amount_of_money',
            'wit$contact',
            'wit$datetime',
            'wit$on_off',
            'wit$phrase_to_translate',
            'wit$temperature',
            'intent',
        ], $response->getEntities());
        $this->assertNull($response->getName());
        $this->assertNull($response->getLang());
        $this->assertNull($response->getLookups());
        $this->assertNull($response->getBuiltin());
        $this->assertNull($response->getDoc());
        $this->assertNull($response->getId());
        $this->assertNull($response->getDeleted());
        $this->assertNull($response->getError());
        $this->assertNull($response->getErrorCode());
    }

    public function testGetEntity()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/get_entity.json');
        $entitiesApi = $this->buildApiWithResponse($bodyResponse);

        $response = $entitiesApi->get('first_name');

        $this->assertFalse($response->getBuiltin());
        $this->assertEquals('User-defined entity', $response->getDoc());
        $this->assertEquals('571979db-f6ac-4820-bc28-a1e0787b98fc', $response->getId());
        $this->assertEquals('en', $response->getLang());
        $this->assertEquals('first_name', $response->getName());
        $this->assertEquals([
            [
                'value' => 'Willy',
                'expressions' => ['Willy'],
            ],
            [
                'value' => 'Laurent',
                'expressions' => ['Laurent'],
            ],
            [
                'value' => 'Julien',
                'expressions' => ['Julien'],
            ],
            [
                'value' => 'Alex',
                'expressions' => ['Alex'],
            ],
        ], $response->getValues());
    }

    public function testPostEntities()
    {
        $bodyResponse = file_get_contents(__DIR__ . '/../../Mocks/Response/post_entities.json');
        $entitiesApi = $this->buildApiWithResponse($bodyResponse);

        $entity = new Entity('favorite_city');
        $entity
            ->setDoc('A city that I like')
            ->addValue((new Entity\Value('Paris'))->setExpressions(['Paris', 'City of Light', 'Capital of France']));

        $response = $entitiesApi->create($entity);

        $this->assertEquals('favorite_city', $response->getName());
        $this->assertEquals('en', $response->getLang());
        $this->assertEquals(['keywords'], $response->getLookups());
        $this->assertFalse($response->getBuiltin());
        $this->assertEquals('A city that I like', $response->getDoc());
        $this->assertEquals('5418abc7-cc68-4073-ae9e-3a5c3c81d965', $response->getId());
        $this->assertEmpty($response->getEntities());
        $this->assertNull($response->getDeleted());
        $this->assertNull($response->getError());
        $this->assertNull($response->getErrorCode());
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

        return new Entities('1234abcd', $client);
    }
}