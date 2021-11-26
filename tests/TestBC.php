<?php

namespace Tests;

use Fize\Math\BC;
use PHPUnit\Framework\TestCase;

class TestBC extends TestCase
{

    public function testAdd()
    {
        $result = BC::add('110', '229');
        self::assertEquals('339', $result);

        $result2 = BC::add('110.2', '229.2', 1);
        self::assertEquals('339.4', $result2);
    }

    public function testAdds()
    {
        $operands = ['110', '229', 400];
        $result = BC::adds($operands);
        self::assertEquals('739', $result);
    }

    public function testComp()
    {
        $result1 = BC::comp('-110', -110);
        self::assertEquals(0, $result1);

        $result2 = BC::comp(110, 100);
        self::assertEquals(1, $result2);

        $result3 = BC::comp(99, 100);
        self::assertEquals(-1, $result3);
    }

    public function testDiv()
    {
        $result = BC::div(5, 2, 1);
        self::assertEquals('2.5', $result);
    }

    public function testDivs()
    {
        $result = BC::divs(5, [2, 1, 2], 2);
        self::assertEquals('1.25', $result);
    }

    public function testMod()
    {
        $result = BC::mod(19, 5);
        self::assertEquals(4, $result);
    }

    public function testMul()
    {
        $result = BC::mul(20, 5);
        self::assertEquals(100, $result);
    }

    public function testMuls()
    {
        $operands = ['4', '5', 5];
        $result = BC::muls($operands);
        self::assertEquals('100', $result);
    }

    public function testPow()
    {
        $result = BC::pow(5, 3);
        self::assertEquals(125, $result);
    }

    public function testPowmod()
    {
        $result = BC::powmod(5, 3, 4);
        self::assertEquals(1, $result);
    }

    public function testScale()
    {
        $result = BC::add('110', '229');
        self::assertEquals('339', $result);

        BC::scale(2);

        $result2 = BC::add('110.2', '229.2');
        self::assertEquals('339.40', $result2);
    }

    public function testSqrt()
    {
        $result = BC::sqrt('2', 3);
        self::assertEquals('1.414', $result);
    }

    public function testSub()
    {
        $result = BC::sub('20', 3, 0);
        self::assertEquals('17', $result);
    }

    public function testSubs()
    {
        $result = BC::subs('20', [3, 4, 5], 0);
        self::assertEquals('8', $result);
    }
}
