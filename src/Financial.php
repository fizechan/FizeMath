<?php


namespace fize\math;

use DateTime;
use Exception;
use RuntimeException;

/**
 * 金融相关
 */
class Financial
{

    /**
     * 计算未来值
     * @param float $rate 期利率
     * @param int   $nper 总期数
     * @param float $pmt  每期金额
     * @param float $pv   现值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function fv($rate, $nper, $pmt, $pv, $type = 0)
    {
        $temp = pow(1 + $rate, $nper);
        if ($rate == 0) {
            $fact = $nper;
        } else {
            $fact = (1 + $rate * $type) * ($temp - 1) / $rate;
        }
        return -($pv * $temp + $pmt * $fact);
    }

    /**
     * 计算现值
     * @param float $rate 期利率
     * @param int   $nper 总期数
     * @param float $pmt  每期金额
     * @param float $fv   未来值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function pv($rate, $nper, $pmt, $fv = 0, $type = 0)
    {
        $temp = pow(1 + $rate, $nper);
        if ($rate == 0) {
            $fact = $nper;
        } else {
            $fact = (1 + $rate * $type) * ($temp - 1) / $rate;
        }
        return -($fv + $pmt * $fact) / $temp;
    }

    /**
     * 净现值
     * @param float $rate   期利率
     * @param array $values 现金流
     * @return float
     */
    public static function npv($rate, array $values)
    {
        $npv = 0;
        foreach ($values as $k => $v) {
            $npv += $v * pow(1 + $rate, -$k);
        }
        return $npv;
    }

    /**
     * 付款金额
     *
     * 对于一项投资或贷款的定期支付数额。
     * @param float $rate 期利率
     * @param int   $nper 总期数
     * @param float $pv   初始本金
     * @param float $fv   本金余值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function pmt($rate, $nper, $pv, $fv = 0, $type = 0)
    {
        $temp = pow(1 + $rate, $nper);
        $mask = $rate == 0;
        $masked_rate = $mask ? 1 : $rate;
        if ($mask != 0) {
            $fact = $nper;
        } else {
            $fact = (1 + $masked_rate * $type) * ($temp - 1) / $masked_rate;
        }
        return -($fv + $pv * $temp) / $fact;
    }

    /**
     * 计算付款的本金部分
     * @param float $rate 期利率
     * @param int   $per  要计算的期数
     * @param int   $nper 总期数
     * @param float $pv   初始本金
     * @param float $fv   本金余值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function ppmt($rate, $per, $nper, $pv, $fv = 0, $type = 0)
    {
        $total = self::pmt($rate, $nper, $pv, $fv, $type);
        return $total - self::ipmt($rate, $per, $nper, $pv, $fv, $type);
    }

    /**
     * 计算付款的利息部分
     * @param float $rate 期利率
     * @param int   $per  要计算的期数
     * @param int   $nper 总期数
     * @param float $pv   初始本金
     * @param float $fv   本金余值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function ipmt($rate, $per, $nper, $pv, $fv = 0, $type = 0)
    {
        $total_pmt = self::pmt($rate, $nper, $pv, $fv, $type);
        $ipmt = self::fv($rate, $per - 1, $total_pmt, $pv, $type) * $rate;
        if ($type == 1) {
            $ipmt = $ipmt / (1 + $rate);
        }
        if ($type == 1 && $per == 1) {
            $ipmt = 0;
        }
        return $ipmt;
    }

    /**
     * 内部收益率
     * @param array $values  现金流
     * @param float $guess   估计值
     * @param int   $precise 精确小数位
     * @param int   $maxiter 尝试次数
     * @return float
     */
    public static function irr(array $values, $guess = 0.1, $precise = 7, $maxiter = 10000)
    {
        if (!self::hasPN($values)) {
            throw new RuntimeException('IRR cannot be calculated: cash flow error!');
        }
        $epsMax = pow(10, -$precise);  // 误差
        $tryCount = 0;
        $oldRate = $guess;
        $newRate = $guess;
        $oldNpv = 0;
        $newNpv = 0;
        $find_irr = false;
        while ($tryCount < $maxiter) {
            $oldNpv = self::npv($oldRate, $values);
            $derivValue = self::firstDeriv($oldRate, $values);
            if ($derivValue == 0) {
                continue;
            }
            $epsRate = $oldNpv / $derivValue;
            $newRate = $oldRate - $epsRate;
            $newNpv = self::npv($newRate, $values);

            if ($oldNpv * $newNpv <= 0 && abs($epsRate) <= $epsMax) {
                $find_irr = true;
                break;
            }

            if ($oldNpv == $newNpv && abs($epsRate) <= $epsMax) {
                $find_irr = true;
                break;
            }

            $oldRate = $newRate;
            $tryCount++;
        }
        if (!$find_irr) {
            throw new RuntimeException('IRR cannot be calculated: out of calculation times!');
        }
        // 出现0则直接取0
        if ($oldRate == 0 || $newRate == 0) {
            return $oldRate == 0 ? (float)$oldRate : (float)$newRate;
        }

        // 两值相同时直接返回
        if ($oldRate == $newRate) {
            return (float)$oldRate;
        }

        // 线性插值算法
        if ($oldNpv > $newNpv) {
            $npv1 = $oldNpv;
            $rate1 = $oldRate;
            $npv2 = $newNpv;
            $rate2 = $newRate;
        } else {
            $npv1 = $newNpv;
            $rate1 = $newRate;
            $npv2 = $oldNpv;
            $rate2 = $oldRate;
        }
        $rate = $npv1 / (abs($npv1) + abs($npv2)) * ($rate2 - $rate1) + $rate1;

        return (float)$rate;
    }

    /**
     * 修正的内部收益率
     * @param array $values        现金流
     * @param float $finance_rate  资金支付的利率
     * @param float $reinvest_rate 再投资的收益率
     * @return float
     */
    public static function mirr(array $values, $finance_rate, $reinvest_rate)
    {
        $n = count($values);
        $npvp = self::npv($reinvest_rate, self::positiveValues($values));
        $npvn = self::npv($finance_rate, self::negativeValues($values));
        return pow(abs($npvp / $npvn), 1 / ($n - 1)) * (1 + $reinvest_rate) - 1;
    }

    /**
     * 定期付款的数量
     * @param float $rate 期利率
     * @param float $pmt  每期金额
     * @param float $pv   初始本金
     * @param float $fv   本金余值
     * @param int   $type 0-期末支付；1期初支付
     * @return float
     */
    public static function nper($rate, $pmt, $pv, $fv = 0, $type = 0)
    {
        try {
            $z = $pmt * (1 + $rate * $type) / $rate;
            $nperA = -($fv + $pv) / ($pmt + 0);
            $nperB = log((-$fv + $z) / ($pv + $z)) / log(1 + $rate);
            return $rate == 0 ? $nperA : $nperB;
        } catch (Exception $e) {
            return (-$fv + $pv) / $pmt;
        }
    }

    /**
     * 计算每个期间的利率
     * @param int   $nper    总期数
     * @param float $pmt     每期金额
     * @param float $pv      初始本金
     * @param float $fv      本金余值
     * @param int   $type    0-期末支付；1期初支付
     * @param float $guess   估计值
     * @param int   $precise 精确小数位
     * @param int   $maxiter 尝试次数
     * @return float
     */
    public static function rate($nper, $pmt, $pv, $fv = 0, $type = 0, $guess = 0.1, $precise = 8, $maxiter = 10000)
    {
        $tol = pow(10, -$precise);  // 误差
        $rn = $guess;
        $iterator = 0;
        $close = false;
        while (($iterator < $maxiter) && !$close) {
            $rnp1 = $rn - self::gDIVgp($rn, $nper, $pmt, $pv, $fv, $type);
            $diff = abs($rnp1 - $rn);
            $close = $diff < $tol;
            $iterator += 1;
            $rn = $rnp1;
        }
        if (!$close) {
            throw new RuntimeException('RATE cannot be calculated: out of calculation times!');
        } else {
            return $rn;
        }
    }

    /**
     * 返回一组现金流的净现值，这些现金流不一定定期发生。
     * @param float $rate   现金流的贴现率
     * @param array $values 现金流
     * @param array $dates  日期表
     * @return float
     */
    public static function xnpv($rate, array $values, array $dates)
    {
        $xnpv = 0;
        $d0 = new DateTime($dates[0]);
        foreach ($values as $i => $v) {
            $di = new DateTime($dates[$i]);
            $days = $di->diff($d0)->days;
            $xnpv += $v / pow(1 + $rate, $days / 365);
        }
        return $xnpv;
    }

    /**
     * 返回一组不一定定期发生的现金流的内部收益率
     * @param array $values  现金流
     * @param array $dates   日期表
     * @param float $guess   估计值
     * @param int   $precise 精确小数位
     * @param int   $maxiter 尝试次数
     * @return float
     */
    public static function xirr(array $values, array $dates, $guess = 0.1, $precise = 8, $maxiter = 10000)
    {
        if (!self::hasPN($values)) {
            throw new RuntimeException('XIRR cannot be calculated: cash flow error!');
        }
        $last_add_Guess = $guess;
        $last_sub_Guess = $guess;
        $residual = 1;
        $step = 0.05;
        $epsilon = pow(10, -$precise);
        while (abs($residual) > $epsilon && $maxiter > 0) {
            $maxiter -= 1;
            $residual = self::xnpv($guess, $values, $dates);
            if (abs($residual) > $epsilon) {
                if ($residual > 0) {
                    $guess += $step;
                    $last_add_Guess = $guess;
                } else {
                    $guess -= $step;
                    $last_sub_Guess = $guess;
                }
                $step = abs($last_add_Guess - $last_sub_Guess) / 2;
                if ($step == 0) {  // 精度丢失导致两猜测值已相同
                    break;
                }
            }
        }
        if ($step != 0 && abs($residual) > $epsilon) {
            throw new RuntimeException('XIRR cannot be calculated: out of calculation times!');
        }
        return (float)$guess;
    }

    /**
     * 判断值是否同时包含正负值
     * @param array $values 要判断的值
     * @return bool
     */
    protected static function hasPN(array $values)
    {
        $hasP = false;
        $hasN = false;
        foreach ($values as $v) {
            if ($v > 0) {
                $hasP = true;
            }
            if ($v < 0) {
                $hasN = true;
            }
            if ($hasP && $hasN) {
                return true;
            }
        }
        return false;
    }

    /**
     * 猜测的值
     * @param float $rate   期利率
     * @param array $values 现金流
     * @return float
     */
    protected static function firstDeriv($rate, array $values)
    {
        $result = 0;
        foreach ($values as $k => $v) {
            if ($k == 0) {
                continue;
            }
            $result -= $k * $v / pow($rate + 1, $k + 1);
        }
        return $result;
    }

    /**
     * 正值数组
     * @param array $values 数组
     * @return array
     */
    protected static function positiveValues(array $values)
    {
        $vals = [];
        foreach ($values as $value) {
            if ($value > 0) {
                $vals[] = $value;
            } else {
                $vals[] = 0;
            }
        }
        return $vals;
    }

    /**
     * 负值数组
     * @param array $values 数组
     * @return array
     */
    protected static function negativeValues(array $values)
    {
        $vals = [];
        foreach ($values as $value) {
            if ($value < 0) {
                $vals[] = $value;
            } else {
                $vals[] = 0;
            }
        }
        return $vals;
    }

    /**
     * 计算 g(r_n)/g'(r_n)
     *
     * g = fv + pv*(1+rate)**nper + pmt*(1+rate*when)/rate * ((1+rate)**nper - 1)
     * @param $r
     * @param $n
     * @param $p
     * @param $x
     * @param $y
     * @param $w
     * @return float
     */
    protected static function gDIVgp($r, $n, $p, $x, $y, $w)
    {
        $t1 = pow($r + 1, $n);
        $t2 = pow($r + 1, $n - 1);
        $g = $y + $t1 * $x + $p * ($t1 - 1) * ($r * $w + 1) / $r;
        $gp = (
            $n * $t2 * $x
            - $p * ($t1 - 1) * ($r * $w + 1) / pow($r, 2)
            + $n * $p * $t2 * ($r * $w + 1) / $r
            + $p * ($t1 - 1) * $w / $r
        );
        return $g / $gp;
    }
}