<?php

namespace Tests;

use Fize\Math\Financial;
use PHPUnit\Framework\TestCase;

class TestFinancial extends TestCase
{

    public function testFv()
    {
        $fv = Financial::fv(0.05 / 12, 360, 6334.495, -1180000);
        var_dump($fv);
        self::assertIsFloat($fv);
    }

    public function testPv()
    {
        $pv = Financial::pv(0.05 / 12, 360, 6334.50);
        var_dump($pv);
        self::assertIsFloat($pv);
    }

    public function testNpv2()
    {
        $values = [];
        $values[] = -1180000.00;
        for ($i = 0; $i < 360; $i++) {
            $values[] = 6334.495;
        }
        self::assertCount(361, $values);
        $npv = Financial::npv(0.05 / 12, $values);
        var_dump($npv);
        self::assertIsFloat($npv);
    }

    public function testNpv()
    {
        $values = [];
        for ($i = 0; $i <= 21; $i++) {
            $values[] = 3000 + $i;
        }
        $ret = Financial::npv(0.003875, $values);
        var_dump($ret);
        $ret = round($ret,2);
//        var_dump($values);
        var_dump($ret);
        self::assertEquals(63365.63, $ret);
    }

    public function testPmt()
    {
        $pmt = Financial::pmt(0.05 / 12, 360, -1180000);
        var_dump($pmt);
        self::assertIsFloat($pmt);

        $pmt = Financial::pmt(0.05 / 12, 360, -1180000, 0, 1);
        var_dump($pmt);
        self::assertIsFloat($pmt);

        $pmt = Financial::pmt(0.05 / 12, 360, -1180000, 100000, 1);
        var_dump($pmt);
        self::assertIsFloat($pmt);
    }

    public function testPpmt()
    {
        $ppmt = Financial::ppmt(0.05 / 12, 2, 360, -1180000);
        var_dump($ppmt);
        self::assertIsFloat($ppmt);

        $ppmt = Financial::ppmt(0.05 / 12, 2, 360, -1180000, 0, 1);
        var_dump($ppmt);
        self::assertIsFloat($ppmt);
    }

    public function testIpmt()
    {
        $ipmt = Financial::ipmt(0.05 / 12, 2, 360, -1180000);
        var_dump($ipmt);
        self::assertIsFloat($ipmt);

        $ipmt = Financial::ipmt(0.05 / 12, 2, 360, -1180000, 0, 1);
        var_dump($ipmt);
        self::assertIsFloat($ipmt);
    }

    public function testIrr()
    {
        $values = [
            -800000.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            77895.00,
            55790.00,
            100
        ];
        self::assertCount(13, $values);
        $irr = Financial::irr($values);
        var_dump($irr);
        self::assertIsFloat($irr);

        $values = [
            -77250.00,
            2803.02,
            2796.99,
            2790.90,
            2784.77,
            2778.59,
            2772.37,
            2766.10,
            2759.77,
            2753.41,
            2746.99,
            2740.52,
            2734.00,
            2727.43,
            2720.80,
            2714.13,
            2707.41,
            2700.64,
            2693.81,
            2686.94,
            2680.00,
            2673.01,
            2665.98,
            2658.88,
            2651.73,
            2644.52,
            2637.27,
            2629.96,
            2622.58,
            2615.16,
            2607.66,
            2600.12,
            2592.52,
            2584.86,
            2577.15,
            2569.36,
            2561.43
        ];
        self::assertCount(37, $values);
        $irr = Financial::irr($values);
        var_dump($irr);
        self::assertIsFloat($irr);
    }

    public function testMirr()
    {
        $mirr = Financial::mirr([-120000, 39000, 30000, 21000, 37000, 46000], 0.1, 0.12);
        var_dump($mirr);
        self::assertIsFloat($mirr);
    }

    public function testNper()
    {
        $nper = Financial::nper(0.05 / 12, 6335, -1180000);
        var_dump($nper);
        self::assertIsFloat($nper);
    }

    public function testRate()
    {
        $rate = Financial::rate(360, 6335, -1180000);
        var_dump($rate);
        self::assertIsFloat($rate);
    }

    public function testXnpv()
    {
        $xnpv = Financial::xnpv(0.5, [-39967, -19866, 245706, 52142], ['2006-01-24', '2008-02-06', '2010-10-18', '2013-09-14']);
        var_dump($xnpv);
        self::assertIsFloat($xnpv);
    }

    public function testXirr()
    {
        $xirr = Financial::xirr([-39967, -19866, 245706, 52142], ['2006-01-24', '2008-02-06', '2010-10-18', '2013-09-14']);
        var_dump($xirr);
        self::assertIsFloat($xirr);
    }
}
