<?php


use fize\math\Financial;
use PHPUnit\Framework\TestCase;

class TestFinancial extends TestCase
{

    public function testFv()
    {
        $fv = Financial::fv(0.05/12, 360, 6334.495, -1180000);
        var_dump($fv);
        self::assertIsFloat($fv);
    }

    public function testPv()
    {
        $pv = Financial::pv(0.05/12, 360, 6334.50);
        var_dump($pv);
        self::assertIsFloat($pv);
    }

    public function testNpv()
    {
        $values = [];
        $values[] = -1180000.00;
        for ($i = 0; $i < 360; $i++) {
            $values[] = 6334.495;
        }
        self::assertCount(361, $values);
        $npv = Financial::npv(0.05/12, $values);
        var_dump($npv);
        self::assertIsFloat($npv);
    }

    public function testPmt()
    {
        $pmt = Financial::pmt(0.05/12, 360, -1180000);
        var_dump($pmt);
        self::assertIsFloat($pmt);

        $pmt = Financial::pmt(0.05/12, 360, -1180000, 0, 1);
        var_dump($pmt);
        self::assertIsFloat($pmt);

        $pmt = Financial::pmt(0.05/12, 360, -1180000, 100000, 1);
        var_dump($pmt);
        self::assertIsFloat($pmt);
    }

    public function testPpmt()
    {
        $ppmt = Financial::ppmt(0.05/12, 2, 360, -1180000);
        var_dump($ppmt);
        self::assertIsFloat($ppmt);

        $ppmt = Financial::ppmt(0.05/12, 2, 360, -1180000, 0, 1);
        var_dump($ppmt);
        self::assertIsFloat($ppmt);
    }

    public function testIpmt()
    {
        $ipmt = Financial::ipmt(0.05/12, 2, 360, -1180000);
        var_dump($ipmt);
        self::assertIsFloat($ipmt);

        $ipmt = Financial::ipmt(0.05/12, 2, 360, -1180000, 0, 1);
        var_dump($ipmt);
        self::assertIsFloat($ipmt);
    }

    public function testIrr()
    {
        $values = [];
        $values[] = -800000.00;
        for ($i = 0; $i < 10; $i++) {
            $values[] = 77895.00;
        }
        $values[] = 55790.00;
        $values[] = 100.00;
        self::assertCount(13, $values);
        $npv = Financial::npv(0.1, $values);
        var_dump($npv);
        self::assertIsFloat($npv);

        $values = [];
        $values[] = 0.00;
        for ($i = 0; $i < 10; $i++) {
            $values[] = 77895.00;
        }
        $values[] = 55790.00;
        $values[] = 100.00;
        self::assertCount(13, $values);
        $npv = Financial::npv(0.1, $values);
        var_dump($npv);
        self::assertIsFloat($npv);

        $values = [];
        $values[] = -800000.00;
        for ($i = 0; $i < 10; $i++) {
            $values[] = 77895.00;
        }
        $values[] = 55790.00;
        $values[] = 100.00;
        self::assertCount(13, $values);
        $irr = Financial::irr($values);
        var_dump($irr);
        self::assertIsFloat($irr);

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
    }

    public function testMirr()
    {
        $mirr = Financial::mirr([-120000, 39000, 30000, 21000, 37000, 46000], 0.1, 0.12);
        var_dump($mirr);
        self::assertIsFloat($mirr);
    }

    public function testNper()
    {
        $nper = Financial::nper(0.05/12, 6335, -1180000);
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
