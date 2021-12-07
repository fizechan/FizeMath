<?php


namespace Fize\Math;

use Fize\Datetime\Date;

/**
 * 等额本金
 */
class EPP
{
    /**
     * @var float 贷款金额
     */
    protected $capital;

    /**
     * @var float 年利率
     */
    protected $annualInterestRate;

    /**
     * @var int 还款期数
     */
    protected $issues;

    /**
     * @var int 每期月数
     */
    protected $issueMonths;

    /**
     * @var int 保留小数位
     */
    protected $scale;

    /**
     * 初始化时设置参数
     * @param float $capital              贷款金额
     * @param float $annual_interest_rate 年利率
     * @param int   $issues               还款期数
     * @param int   $issue_months         每期月数
     * @param int   $scale                保留小数位
     */
    public function __construct(float $capital, float $annual_interest_rate, int $issues, int $issue_months = 1, int $scale = 2)
    {
        $this->capital = $capital;
        $this->annualInterestRate = $annual_interest_rate;
        $this->issues = $issues;
        $this->issueMonths = $issue_months;
        $this->scale = $scale;
    }

    /**
     * 月利率
     * @return float
     */
    public function monthlyInterestRate(): float
    {
        return $this->annualInterestRate / 12;
    }

    /**
     * 期利率
     * @return float
     */
    public function issueInterestRate(): float
    {
        $gap = 12 / $this->issueMonths;
        return $this->annualInterestRate / $gap;
    }

    /**
     * 每期本金
     * @return float
     */
    public function issueCapital(): float
    {
        return round($this->capital / $this->issues, $this->scale);
    }

    /**
     * 还款总额
     * @return float
     */
    public function totalRent(): float
    {
        return $this->totalInterest() + $this->capital;
    }

    /**
     * 总利息
     * @return float
     */
    public function totalInterest(): float
    {
        return ($this->issues + 1) * $this->capital * $this->issueInterestRate() / 2;
    }

    /**
     * 租金计划
     * @param int   $fix_issue       修正的期数，支持负数
     * @param false $with_issue_zero 是否附带第0期(即放款期)
     * @return array 下标 => [租金, 本金, 利息]
     */
    public function plans(int $fix_issue = -1, bool $with_issue_zero = false): array
    {
        $plans = [];
        $plans[] = [-$this->capital, -$this->capital, 0];  // 第0期为放款
        $issue_capital = $this->issueCapital();

        $capital_balance = $this->capital;
        for ($issue = 1; $issue <= $this->issues; $issue++) {
            $capital = round($issue_capital, $this->scale);  // 本金
            $interest = round($capital_balance * $this->issueInterestRate(), $this->scale);  // 利息
            $issue_rent = round($capital + $interest, $this->scale);  // 租金
            $plans[$issue] = [$issue_rent, $capital, $interest];
            $capital_balance = round($capital_balance - $capital, $this->scale);
        }

        // 修正一期使全部本金相加等于总本金
        if ($fix_issue < 0) {
            $fix_issue = count($plans) + $fix_issue;
        }
        $capital_sum = 0.00;
        for ($issue = 1; $issue <= $this->issues; $issue++) {
            if ($issue != $fix_issue) {
                $capital_sum = round($capital_sum + $plans[$issue][1], $this->scale);
            }
        }
        $capital_fix = round($this->capital - $capital_sum, $this->scale);
        $rent_fix = round($capital_fix + $plans[$fix_issue][2], $this->scale);
        $plans[$fix_issue] = [$rent_fix, $capital_fix, $plans[$fix_issue][2]];

        if (!$with_issue_zero) {
            array_shift($plans);
        }

        return $plans;
    }

    /**
     * 含日期信息的租金计划
     * @param string $loan_date       起租日期
     * @param int    $fix_issue       修正的期数
     * @param false  $with_issue_zero 是否附带第0期(即放款期)
     * @return array 日期 => [租金, 本金, 利息]
     */
    public function datePlans(string $loan_date, int $fix_issue = -1, bool $with_issue_zero = false): array
    {
        $plans = $this->plans($fix_issue, true);
        $datePlans = [];
        for ($issue = 0; $issue <= $this->issues; $issue++) {
            $date = Date::get($loan_date, $issue * $this->issueMonths);
            $datePlans[$date] = $plans[$issue];
        }
        if (!$with_issue_zero) {
            unset($datePlans[$loan_date]);
        }
        return $datePlans;
    }
}