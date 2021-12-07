<?php

namespace Tests;

use Fize\Math\EPP;
use PHPUnit\Framework\TestCase;

class TestEPP extends TestCase
{

    public function test__construct()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        var_dump($epp);
        self::assertIsObject($epp);
    }

    public function testMonthlyInterestRate()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $mir = $epp->monthlyInterestRate();
        var_dump($mir);
        self::assertIsFloat($mir);
    }

    public function testIssueInterestRate()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $iir = $epp->issueInterestRate();
        var_dump($iir);
        self::assertIsFloat($iir);
    }

    public function testIssueCapital()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $rent = $epp->issueCapital();
        var_dump($rent);
        self::assertIsFloat($rent);
    }

    public function testTotalRent()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $rent = $epp->totalRent();
        var_dump($rent);
        self::assertIsFloat($rent);
    }

    public function testTotalInterest()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $interest = $epp->totalInterest();
        var_dump($interest);
        self::assertIsFloat($interest);
    }

    public function testPlans()
    {
        $epp = new EPP(1180000.00, 0.0525, 360);
        $plans = $epp->plans();
        var_export($plans);
        self::assertIsArray($plans);
    }

    public function testDatePlans()
    {
        $epp = new EPP(1180000.00, 0.05, 360);
        $date_plans = $epp->datePlans('2021-06-30');
        var_export($date_plans);
        self::assertIsArray($date_plans);
    }
}
