<?php
namespace Kerox\Wit\Test\TestCase;

use Kerox\Wit\Api\App;
use Kerox\Wit\Api\Converse;
use Kerox\Wit\Api\Entities;
use Kerox\Wit\Api\Message;
use Kerox\Wit\Api\Sample;
use Kerox\Wit\Wit;

class WitTest extends AbstractTestCase
{

    /**
     * @var \Kerox\Wit\Wit
     */
    protected $wit;

    public function setUp()
    {
        $this->wit = new Wit('4321dcba');
    }

    public function testGetInstanceOfApi()
    {
        $this->assertInstanceOf(App::class, $this->wit->app());
        $this->assertInstanceOf(Converse::class, $this->wit->converse());
        $this->assertInstanceOf(Entities::class, $this->wit->entities());
        $this->assertInstanceOf(Message::class, $this->wit->message());
        $this->assertInstanceOf(Sample::class, $this->wit->sample());
    }

    public function tearDown()
    {
        unset($this->wit);
    }
}