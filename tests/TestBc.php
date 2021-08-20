<?php

use fize\math\Bc;
use PHPUnit\Framework\TestCase;

class TestBc extends TestCase
{

    public function testAdd()
    {
        $result = Bc::add('110', '229');
        self::assertEquals('339', $result);

        $result2 = Bc::add('110.2', '229.2', 1);
        self::assertEquals('339.4', $result2);
    }

    public function testAdds()
    {
        $operands = ['110', '229', 400];
        $result = Bc::adds($operands);
        self::assertEquals('739', $result);
    }

    public function testComp()
    {
        $result1 = Bc::comp('-110', -110);
        self::assertEquals(0, $result1);

        $result2 = Bc::comp(110, 100);
        self::assertEquals(1, $result2);

        $result3 = Bc::comp(99, 100);
        self::assertEquals(-1, $result3);
    }

    public function testDiv()
    {
        $result = Bc::div(5, 2, 1);
        self::assertEquals('2.5', $result);
    }

    public function testDivs()
    {
        $result = Bc::divs(5, [2, 1, 2], 2);
        self::assertEquals('1.25', $result);
    }

    public function testMod()
    {
        $result = Bc::mod(19, 5);
        self::assertEquals(4, $result);
    }

    public function testMul()
    {
        $result = Bc::mul(20, 5);
        self::assertEquals(100, $result);
    }

    public function testMuls()
    {
        $operands = ['4', '5', 5];
        $result = Bc::muls($operands);
        self::assertEquals('100', $result);
    }

    public function testPow()
    {
        $result = Bc::pow(5, 3);
        self::assertEquals(125, $result);
    }

    public function testPowmod()
    {
        $result = Bc::powmod(5, 3, 4);
        self::assertEquals(1, $result);
    }

    public function testScale()
    {
        $result = Bc::add('110', '229');
        self::assertEquals('339', $result);

        Bc::scale(2);

        $result2 = Bc::add('110.2', '229.2');
        self::assertEquals('339.40', $result2);
    }

    public function testSqrt()
    {
        $result = Bc::sqrt('2', 3);
        self::assertEquals('1.414', $result);
    }

    public function testSub()
    {
        $result = Bc::sub('20', 3, 0);
        self::assertEquals('17', $result);
    }

    public function testSubs()
    {
        $result = Bc::subs('20', [3, 4, 5], 0);
        self::assertEquals('8', $result);
    }
}
