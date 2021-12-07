<?php

namespace Tests;

use Fize\Math\ELP;
use PHPUnit\Framework\TestCase;

class TestELP extends TestCase
{

    public function test__construct()
    {
        $elp = new ELP(1180000.00, 0.0525, 360);
        var_dump($elp);
        self::assertIsObject($elp);
    }

    public function testMonthlyInterestRate()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $mir = $elp->monthlyInterestRate();
        var_dump($mir);
        self::assertIsFloat($mir);
    }

    public function testIssueInterestRate()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $iir = $elp->issueInterestRate();
        var_dump($iir);
        self::assertIsFloat($iir);
    }

    public function testIssueRent()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $rent = $elp->issueRent();
        var_dump($rent);
        self::assertIsFloat($rent);
    }

    public function testTotalRent()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $rent = $elp->totalRent();
        var_dump($rent);
        self::assertIsFloat($rent);
    }

    public function testTotalInterest()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $interest = $elp->totalInterest();
        var_dump($interest);
        self::assertIsFloat($interest);
    }

    public function testPlans()
    {
        $elp = new ELP(1180000.00, 0.0525, 360);
        $plans = $elp->plans();
        var_export($plans);
        self::assertIsArray($plans);
    }

    public function testDatePlans()
    {
        $elp = new ELP(1180000.00, 0.05, 360);
        $date_plans = $elp->datePlans('2021-06-30');
        var_export($date_plans);
        self::assertIsArray($date_plans);
    }
}
