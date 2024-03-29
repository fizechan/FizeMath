<?php

namespace Tests;

use Fize\Math\GMP;
use PHPUnit\Framework\TestCase;

class TestGMP extends TestCase
{

    public function testAbs()
    {
        $a = GMP::abs('-123');
        var_dump($a);
        $as = GMP::strval($a);
        var_dump($as);
        self::assertEquals('123', $as);
    }

    public function testAdd()
    {
        $a = GMP::add('123', '321');
        var_dump($a);
        $as = GMP::strval($a);
        var_dump($as);
        self::assertEquals('444', $as);
    }

    public function testAnd()
    {

    }

    public function testPopcount()
    {

    }

    public function testKronecker()
    {

    }

    public function testPow()
    {

    }

    public function testScan1()
    {

    }

    public function testOr()
    {

    }



    public function testPowm()
    {

    }

    public function testSub()
    {

    }

    public function testLegendre()
    {

    }

    public function testSign()
    {

    }

    public function testClrbit()
    {

    }

    public function testPerfectSquare()
    {

    }

    public function testRandom()
    {

    }

    public function testBinomial()
    {

    }

    public function testDivR()
    {

    }

    public function testJacobi()
    {

    }

    public function testRandomRange()
    {

    }

    public function testCmp()
    {

    }



    public function testHamdist()
    {

    }

    public function testImport()
    {

    }

    public function testXor()
    {

    }

    public function testMod()
    {

    }

    public function testFact()
    {

    }

    public function testRandomBits()
    {

    }

    public function testLcm()
    {

    }

    public function testGcdext()
    {

    }

    public function testNeg()
    {

    }

    public function testSetbit()
    {

    }

    public function testExport()
    {

    }

    public function testRandomSeed()
    {

    }

    public function testTestbit()
    {

    }

    public function testIntval()
    {

    }

    public function testRoot()
    {

    }

    public function testInit()
    {

    }

    public function testDivexact()
    {

    }

    public function testDivQ()
    {

    }

    public function testSqrtrem()
    {

    }

    public function testDivQr()
    {

    }



    public function testScan0()
    {

    }

    public function testInvert()
    {

    }

    public function testNextprime()
    {

    }

    public function testPerfectPower()
    {

    }

    public function testStrval()
    {

    }

    public function testMul()
    {

    }

    public function testGcd()
    {

    }

    public function testCom()
    {

    }

    public function testProbPrime()
    {

    }

    public function testRootrem()
    {

    }

    public function testDiv()
    {

    }

    public function testSqrt()
    {

    }
}
