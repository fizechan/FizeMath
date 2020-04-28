<?php


use fize\math\Bc;
use PHPUnit\Framework\TestCase;

class TestBc extends TestCase
{

    public function testAdd()
    {
        $result = Bc::add('110', '229');
        self::assertEquals($result, '339');

        $result2 = Bc::add('110.2', '229.2', 1);
        self::assertEquals($result2, '339.4');
    }

    public function testAdds()
    {
        $operands = ['110', '229', 400];
        $result = Bc::adds($operands);
        self::assertEquals($result, '739');
    }

    public function testComp()
    {
        $result1 = Bc::comp('-110', -110);
        self::assertEquals($result1, 0);

        $result2 = Bc::comp(110, 100);
        self::assertEquals($result2, 1);

        $result3 = Bc::comp(99, 100);
        self::assertEquals($result3, -1);
    }

    public function testDiv()
    {
        $result = Bc::div(5, 2, 1);
        self::assertEquals($result, '2.5');
    }

    public function testMod()
    {
        $result = Bc::mod(19, 5);
        self::assertEquals($result, 4);
    }

    public function testMul()
    {
        $result = Bc::mul(20, 5);
        self::assertEquals($result, 100);
    }

    public function testMuls()
    {
        $operands = ['4', '5', 5];
        $result = Bc::muls($operands);
        self::assertEquals($result, '100');
    }

    public function testPow()
    {
        $result = Bc::pow(5, 3);
        self::assertEquals($result, 125);
    }

    public function testPowmod()
    {
        $result = Bc::powmod(5, 3, 4);
        self::assertEquals($result, 1);
    }

    public function testScale()
    {
        $result = Bc::add('110', '229');
        self::assertEquals($result, '339');

        Bc::scale(2);

        $result2 = Bc::add('110.2', '229.2');
        self::assertEquals($result2, '339.40');
    }

    public function testSqrt()
    {
        $result = Bc::sqrt('2', 3);
        self::assertEquals($result, '1.414');
    }

    public function testSub()
    {
        $result = Bc::sub('20', 3, 0);
        self::assertEquals($result, '17');
    }
}
