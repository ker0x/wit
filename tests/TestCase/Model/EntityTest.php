<?php
namespace Kerox\Wit\Test\TestCase\Model;

use Kerox\Wit\Model\Entity;
use Kerox\Wit\Model\Entity\Value;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class EntityTest extends AbstractTestCase
{

    public function testEntity()
    {
        $json = file_get_contents(__DIR__ . '/../../Mocks/Model/entity.json');

        $entity = new Entity('action_type');
        $entity
            ->setDoc('Detect the type of action')
            ->setLookups(['trait'])
            ->addLookup('keywords')
            ->setValues([
                (new Value('booking'))
                    ->setExpressions([
                        'I want to book at flight',
                        'I need to buy a ticket'
                    ])
                    ->addExpression('need to book a cab')
            ])
            ->addValue((new Value('scraping')));

        $this->assertJsonStringEqualsJsonString($json, json_encode($entity));
    }
}