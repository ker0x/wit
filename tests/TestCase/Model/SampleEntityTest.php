<?php
namespace Kerox\Wit\Test\TestCase\Model;

use Kerox\Wit\Model\SampleEntity;
use Kerox\Wit\Test\TestCase\AbstractTestCase;

class SampleEntityTest extends AbstractTestCase
{

    public function testSampleEntity()
    {
        $json = file_get_contents(__DIR__ . '/../../Mocks/Model/sample_enity.json');
        $sampleEntity = new SampleEntity('wit$location');
        $sampleEntity
            ->setValue('flight_request')
            ->setStart(17)
            ->setEnd(20);

        $this->assertJsonStringEqualsJsonString($json, json_encode($sampleEntity));
    }
}