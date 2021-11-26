<?php

namespace Fize\Math;

use GMP as GMP_;

/**
 * GMP数学扩展
 */
class GMP
{

    /**
     * 获取绝对值
     * @param GMP_|string $a 值
     * @return GMP_
     */
    public static function abs($a): GMP_
    {
        return gmp_abs($a);
    }

    /**
     * 加法运算
     * @param GMP_|string $a 被加数
     * @param GMP_|string $b 加数
     * @return GMP_
     */
    public static function add($a, $b): GMP_
    {
        return gmp_add($a, $b);
    }

    /**
     * AND运算
     * @param GMP_|string $a 值1
     * @param GMP_|string $b 值2
     * @return GMP_
     */
    public static function and($a, $b): GMP_
    {
        return gmp_and($a, $b);
    }

    /**
     * 二项式系数计算
     * @param GMP_|string $n
     * @param int         $k 整数
     * @return GMP_ 失败时返回false
     * @since PHP7.3.0
     */
    public static function binomial($n, int $k): GMP_
    {
        return gmp_binomial($n, $k);
    }

    /**
     * 清除位索引
     * @param GMP_|string $a
     * @param int         $index 索引，从0开始
     */
    public static function clrbit(&$a, int $index)
    {
        gmp_clrbit($a, $index);
    }

    /**
     * 比较数值
     * @param GMP_|string $a 值1
     * @param GMP_|string $b 值2
     * @return int 值1>值2返回1，值1=值2返回0，值1小于值2返回-1
     */
    public static function cmp($a, $b): int
    {
        return gmp_cmp($a, $b);
    }

    /**
     * 计算数值的补码
     * @param GMP_|string $a 数值
     * @return GMP_
     */
    public static function com($a): GMP_
    {
        return gmp_com($a);
    }

    /**
     * 除法运算得商
     * @param GMP_|string $a     被除数
     * @param GMP_|string $b     除数
     * @param int         $round 余数处理方法选项
     * @return GMP_
     */
    public static function divQ($a, $b, int $round = 0): GMP_
    {
        return gmp_div_q($a, $b, $round);
    }

    /**
     * 除数得商和余
     * @param GMP_|string $n 被除数
     * @param GMP_|string $d 除数
     * @param int         $round
     * @return array 余数处理方法选项
     */
    public static function divQr($n, $d, int $round = 0): array
    {
        return gmp_div_qr($n, $d, $round);
    }

    /**
     * 除法运算得余
     * @param GMP_|string $n     被除数
     * @param GMP_|string $d     除数
     * @param int         $round 余数处理方法选项
     * @return GMP_
     */
    public static function divR($n, $d, int $round = 0): GMP_
    {
        return gmp_div_r($n, $d, $round);
    }

    /**
     * 除法运算得商
     * @param GMP_|string $a     被除数
     * @param GMP_|string $b     除数
     * @param int         $round 余数处理方法选项
     * @return GMP_
     */
    public static function div($a, $b, int $round = 0): GMP_
    {
        return gmp_div($a, $b, $round);
    }

    /**
     * 精确除数法
     * @param GMP_|string $n 被除数
     * @param GMP_|string $d 除数
     * @return GMP_
     */
    public static function divexact($n, $d): GMP_
    {
        return gmp_divexact($n, $d);
    }

    /**
     * 导出到二进制字符串
     * @param GMP_ $gmpnumber
     * @param int  $word_size
     * @param int  $options
     * @return string 失败时返回false
     */
    public static function export(GMP_ $gmpnumber, int $word_size = 1, int $options = 1 | 16): string
    {
        return gmp_export($gmpnumber, $word_size, $options);
    }

    /**
     * 阶乘
     * @param $a
     * @return GMP_
     */
    public static function fact($a): GMP_
    {
        return gmp_fact($a);
    }

    /**
     * 最大公约数
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function gcd($a, $b): GMP_
    {
        return gmp_gcd($a, $b);
    }

    /**
     * 计算g, s, t，使得a*s + b*t =g =gcd(a,b)。
     *
     * 其中gcd是最大公约数。返回各自元素g、s和t的数组。
     * @param $a
     * @param $b
     * @return array
     */
    public static function gcdext($a, $b): array
    {
        return gmp_gcdext($a, $b);
    }

    /**
     * 哈明距离
     * @param $a
     * @param $b
     * @return int
     */
    public static function hamdist($a, $b): int
    {
        return gmp_hamdist($a, $b);
    }

    /**
     * 从二进制字符串导入
     * @param     $data
     * @param int $word_size
     * @param int $options
     * @return false|GMP_
     */
    public static function import($data, int $word_size = 1, int $options = 1 | 16)
    {
        return gmp_import($data, $word_size, $options);
    }

    /**
     * 创建一个GMP数值
     * @param     $number
     * @param int $base
     * @return GMP_
     */
    public static function init($number, int $base = 0): GMP_
    {
        return gmp_init($number, $base);
    }

    /**
     * 将数值转化为int类型
     * @param GMP_|string $gmpnumber
     * @return int
     */
    public static function intval($gmpnumber): int
    {
        return gmp_intval($gmpnumber);
    }

    /**
     * 逆的模
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function invert($a, $b): GMP_
    {
        return gmp_invert($a, $b);
    }

    /**
     * 雅可比符号
     * @param $a
     * @param $p
     * @return int
     */
    public static function jacobi($a, $p): int
    {
        return gmp_jacobi($a, $p);
    }

    /**
     * 克罗内克符号
     * @param $a
     * @param $b
     * @return int
     * @since PHP7.3.0
     */
    public static function kronecker($a, $b): int
    {
        return gmp_kronecker($a, $b);
    }

    /**
     * 预期最大公约数
     * @param $a
     * @param $b
     * @return GMP_
     * @since PHP7.3.0
     */
    public static function lcm($a, $b): GMP_
    {
        return gmp_lcm($a, $b);
    }

    /**
     * 勒让德符号
     * @param $a
     * @param $p
     * @return int
     */
    public static function legendre($a, $p): int
    {
        return gmp_legendre($a, $p);
    }

    /**
     * 模操作
     * @param $n
     * @param $d
     * @return GMP_
     */
    public static function mod($n, $d): GMP_
    {
        return gmp_mod($n, $d);
    }

    /**
     * 乘法运算
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function mul($a, $b): GMP_
    {
        return gmp_mul($a, $b);
    }

    /**
     * 返回一个数字的负值。
     * @param $a
     * @return GMP_
     */
    public static function neg($a): GMP_
    {
        return gmp_neg($a);
    }

    /**
     * 求下一个质数
     * @param $a
     * @return GMP_
     */
    public static function nextprime($a): GMP_
    {
        return gmp_nextprime($a);
    }

    /**
     * OR操作
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function or($a, $b): GMP_
    {
        return gmp_or($a, $b);
    }

    /**
     * 完美幂检查
     * @param $a
     * @return bool
     * @since PHP7.3.0
     */
    public static function perfectPower($a): bool
    {
        return gmp_perfect_power($a);
    }

    /**
     * 完全平方检查
     * @param $a
     * @return bool
     */
    public static function perfectSquare($a): bool
    {
        return gmp_perfect_square($a);
    }

    /**
     * 种群统计
     * @param $a
     * @return int
     */
    public static function popcount($a): int
    {
        return gmp_popcount($a);
    }

    /**
     * 幂运算
     * @param $base
     * @param $exp
     * @return GMP_
     */
    public static function pow($base, $exp): GMP_
    {
        return gmp_pow($base, $exp);
    }

    /**
     * 幂运算取模
     * @param $base
     * @param $exp
     * @param $mod
     * @return GMP_
     */
    public static function powm($base, $exp, $mod): GMP_
    {
        return gmp_powm($base, $exp, $mod);
    }

    /**
     * 检查number是否为素数
     * @param     $a
     * @param int $reps
     * @return int
     */
    public static function probPrime($a, int $reps = 10): int
    {
        return gmp_prob_prime($a, $reps);
    }

    /**
     * 随机数
     * @param $bits
     * @return GMP_
     */
    public static function randomBits($bits): GMP_
    {
        return gmp_random_bits($bits);
    }

    /**
     * 产生范围内随机数
     * @param $min
     * @param $max
     * @return GMP_
     */
    public static function randomRange($min, $max): GMP_
    {
        return gmp_random_range($min, $max);
    }

    /**
     * 设置随机数种子
     * @param GMP_|string $seed
     * @return false|void|null
     */
    public static function randomSeed($seed)
    {
        return gmp_random_seed($seed);
    }

    /**
     * 随机数
     * @param int $limiter
     * @return GMP_
     * @deprecated 该方法自PHP7.2后被移除，不鼓励使用该方法
     */
    public static function random(int $limiter = 20): GMP_
    {
        return gmp_random($limiter);
    }

    /**
     * 取n次方根的整数部分
     * @param $a
     * @param $nth
     * @return GMP_
     */
    public static function root($a, $nth): GMP_
    {
        return gmp_root($a, $nth);
    }

    /**
     * 取n次根的整数部分和余数
     * @param GMP_ $a
     * @param      $nth
     * @return array
     */
    public static function rootrem(GMP_ $a, $nth): array
    {
        return gmp_rootrem($a, $nth);
    }

    /**
     * 扫描0
     * @param $a
     * @param $start
     * @return int
     */
    public static function scan0($a, $start): int
    {
        return gmp_scan0($a, $start);
    }

    /**
     * 扫描1
     * @param $a
     * @param $start
     * @return int
     */
    public static function scan1($a, $start): int
    {
        return gmp_scan1($a, $start);
    }

    /**
     * 设置二进位
     * @param      $a
     * @param      $index
     * @param bool $set_clear
     */
    public static function setbit(&$a, $index, bool $set_clear = true)
    {
        return gmp_setbit($a, $index, $set_clear);
    }

    /**
     * 检查数字的符号。
     * @param $a
     * @return int
     */
    public static function sign($a): int
    {
        return gmp_sign($a);
    }

    /**
     * 计算平方根
     * @param $a
     * @return GMP_
     */
    public static function sqrt($a): GMP_
    {
        return gmp_sqrt($a);
    }

    /**
     * 余数平方根
     * @param $a
     * @return array
     */
    public static function sqrtrem($a): array
    {
        return gmp_sqrtrem($a);
    }

    /**
     * 将数值转化为字符串
     * @param GMP_|string|int $gmpnumber 数值
     * @param int             $base      进制
     * @return string
     */
    public static function strval($gmpnumber, int $base = 10): string
    {
        return gmp_strval($gmpnumber, $base);
    }

    /**
     * 减法运算
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function sub($a, $b): GMP_
    {
        return gmp_sub($a, $b);
    }

    /**
     * 测试是否设置了二进位
     * @param $a
     * @param $index
     * @return bool
     */
    public static function testbit($a, $index): bool
    {
        return gmp_testbit($a, $index);
    }

    /**
     * XOR运算
     * @param $a
     * @param $b
     * @return GMP_
     */
    public static function xor($a, $b): GMP_
    {
        return gmp_xor($a, $b);
    }

}
