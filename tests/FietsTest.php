<?php

use PHPUnit\Framework\TestCase;
use App\Model\Fiets;

class FietsTest extends TestCase
{
    private Fiets $fiets;

    protected function setUp(): void
    {
        $this->fiets = new Fiets(
            1,
            'Koga',
            'Elektrisch',
            1200
        );
    }

    public function testGetId()
    {
        $this->assertEquals(1, $this->fiets->getId());
    }

    public function testGetMerk()
    {
        $this->assertEquals('Koga', $this->fiets->getMerk());
    }

    public function testGetType()
    {
        $this->assertEquals('Elektrisch', $this->fiets->getType());
    }

    public function testGetPrijs()
    {
        $this->assertEquals(1200, $this->fiets->getPrijs());
    }
}
