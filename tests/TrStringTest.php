<?php

namespace Epigra\Tests;

use Epigra\TRStringHelper;
use PHPUnit\Framework\TestCase;

class TrStringTest extends TestCase
{
    public function testToLower()
    {
        return $this->assertEquals('deneme. çğışöiü', $this->getInstance()->toLower()->result());
    }

    public function testToUpper()
    {
        return $this->assertEquals('DENEME. ÇĞIŞÖİÜ', $this->getInstance()->toUpper()->result());
    }

    public function testUcFirst()
    {
        return $this->assertEquals('Deneme. çğışöiü', $this->getInstance()->ucFirst()->result());
    }

    public function testUcWords()
    {
        return $this->assertEquals('Deneme. Çğışöiü', $this->getInstance()->ucWords()->result());
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
        return new TRStringHelper('dEneMe. çĞıŞöİÜ');
    }
}
