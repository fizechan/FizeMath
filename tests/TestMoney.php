<?php


use fize\math\Money;
use PHPUnit\Framework\TestCase;

class TestMoney extends TestCase
{

    public function testUpper()
    {
        $number = 123456789.01;
        $rmb = Money::upper($number);
        var_dump($rmb);
        self::assertIsString($rmb);
    }
}
