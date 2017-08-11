<?php

namespace Epigra\Tests;

use Epigra\TRStringHelper;
use PHPUnit\Framework\TestCase;

class TrStringTest extends TestCase
{
    public function testToLower()
    {
        return $this->assertEquals('deneme. çğışöiü ılgazım imgecim', $this->getInstance()->toLower()->result());
    }

    public function testToUpper()
    {
        return $this->assertEquals('DENEME. ÇĞIŞÖİÜ ILGAZIM İMGECİM', $this->getInstance()->toUpper()->result());
    }

    public function testUcFirst()
    {
        return $this->assertEquals('Deneme. çğışöiü ılgazım imgecim', $this->getInstance()->ucFirst()->result());
    }

    public function testUcWords()
    {
        return $this->assertEquals('Deneme. Çğışöiü Ilgazım İmgecim', $this->getInstance()->ucWords()->result());
    }

    public function testString()
    {
        return $this->assertEquals('ğışöiü', (new TRStringHelper())->withString('ĞıŞöİÜ')->toLower()->result());
    }

    public function testPangram()
    {
        return $this->assertEquals('Cümleten Şef Garsonun Verdiği Hafif Jöle Kıvamında Poğaçaya Bakıyoruz.', (new TRStringHelper())->withPangram(false)->ucWords()->result());
    }

    private function getInstance()
    {
        return new TRStringHelper('dEneMe. çĞıŞöİÜ ILGAZIM İMGECİM');
    }
}
