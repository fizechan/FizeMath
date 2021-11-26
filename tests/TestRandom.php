<?php

namespace Tests;

use Fize\Math\Random;
use PHPUnit\Framework\TestCase;

class TestRandom extends TestCase
{

    public function testAlnum()
    {
        $str = Random::alnum();
        var_dump($str);
        self::assertIsString($str);
    }

    public function testAlpha()
    {
        $str = Random::alpha(8);
        var_dump($str);
        self::assertIsString($str);
    }

    public function testNumeric()
    {
        $str = Random::numeric(10);
        var_dump($str);
        self::assertIsString($str);
    }

    public function testNozero()
    {
        $str = Random::nozero(10);
        var_dump($str);
        self::assertIsString($str);
    }

    public function testUniqid()
    {
        $str = Random::uniqid();
        var_dump($str);
        self::assertIsString($str);
    }

    public function testMd5()
    {
        $str = Random::md5();
        var_dump($str);
        self::assertIsString($str);
    }

    public function testSha1()
    {
        $str = Random::sha1();
        var_dump($str);
        self::assertIsString($str);
    }

    public function testLottery()
    {
        $ps = [
            '第一名' => 10,
            '第二名' => 20,
            '第三名' => 30,
            '第四名' => 40
        ];
        $key = Random::lottery($ps);
        var_dump($key);
        self::assertArrayHasKey($key, $ps);
    }

    public function testUuid()
    {
        $str = Random::uuid();
        var_dump($str);
        self::assertIsString($str);
    }
}
