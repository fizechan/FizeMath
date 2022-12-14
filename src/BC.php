<?php

namespace Fize\Math;

/**
 * BCMath高精度数学类
 *
 * 各参数可以是字符串，也可以是原值。
 * 由于精度问题，建议参数都以字符串形式传递。
 */
class BC
{

    /**
     * 禁止实例化
     */
    private function __construct()
    {
    }

    /**
     * 返回2个任意精度数字的加法计算，返回字符串结果
     * @param float|int|string $leftOperand  第一个数字
     * @param float|int|string $rightOperand 第二个数字
     * @param int|null         $scale        指定结果小数位，默认是自动
     * @return string
     */
    public static function add($leftOperand, $rightOperand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcadd((string)$leftOperand, (string)$rightOperand);
        } else {
            return bcadd((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 累加多个任意精度数字的加法计算
     * @param array    $operands 要累加的数值
     * @param int|null $scale    指定结果小数位，默认是自动
     * @return string
     */
    public static function adds(array $operands, int $scale = null): string
    {
        $total = '0';
        foreach ($operands as $operand) {
            $total = self::add($total, $operand, $scale);
        }
        return $total;
    }

    /**
     * 把right_operand和left_operand作比较, 并且返回一个整数的结果.
     * @param float|int|string $leftOperand  左边的运算数
     * @param float|int|string $rightOperand 右边的运算数
     * @param int|null         $scale        设置指示数字， 在使用来作比较的小数点部分. 默认比较全部
     * @return int 如果两个数相等返回0, 左边的数left_operand比较右边的数right_operand大返回1, 否则返回-1.
     */
    public static function comp($leftOperand, $rightOperand, int $scale = null): int
    {
        if (is_null($scale)) {
            return bccomp((string)$leftOperand, (string)$rightOperand);
        } else {
            return bccomp((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 2个任意精度的数字除法计算
     * @param float|int|string $leftOperand  被除数
     * @param float|int|string $rightOperand 除数
     * @param int|null         $scale        指定结果小数位，默认是自动
     * @return string 返回结果为字符串类型的结果，如果右操作数是0结果为null
     */
    public static function div($leftOperand, $rightOperand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcdiv((string)$leftOperand, (string)$rightOperand);
        } else {
            return bcdiv((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 多个任意精度的数字除法计算
     * @param float|int|string $leftOperand   被除数
     * @param array            $rightOperands 除数组成的数组
     * @param int|null         $scale         指定结果小数位，默认是自动
     * @return string 返回结果为字符串类型的结果，如果右操作数是0结果为null
     */
    public static function divs($leftOperand, array $rightOperands, int $scale = null): string
    {
        $rightOperand = self::muls($rightOperands, $scale);
        return self::div($leftOperand, $rightOperand, $scale);
    }

    /**
     * 对一个任意精度数字取模
     * @param float|int|string $leftOperand 左操作数
     * @param float|int|string $modulus     系数
     * @return string 返回字符串类型取模后结果，如果系数为0则返回null
     * @since PHP7.2
     */
    public static function mod($leftOperand, $modulus): string
    {
        return bcmod((string)$leftOperand, (string)$modulus);
    }

    /**
     * 2个任意精度数字乘法计算
     * @param float|int|string $leftOperand  左操作数
     * @param float|int|string $rightOperand 右操作数
     * @param int|null         $scale        设置结果中小数点后的小数位数
     * @return string 返回计算结果字符串
     */
    public static function mul($leftOperand, $rightOperand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcmul((string)$leftOperand, (string)$rightOperand);
        } else {
            return bcmul((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 多个任意精度数字的乘法法计算，返回字符串结果
     * @param array    $operands 要累乘的数值组成的数组
     * @param int|null $scale    指定结果小数位，默认是自动
     * @return string
     */
    public static function muls(array $operands, int $scale = null): string
    {
        $muls = '1';
        foreach ($operands as $operand) {
            $muls = self::mul($muls, $operand, $scale);
        }
        return $muls;
    }

    /**
     * 任意精度数字的乘方
     * @param float|int|string $leftOperand  底数
     * @param int|string       $rightOperand 乘方
     * @param int|null         $scale         设置结果中小数点后的小数位数
     * @return string
     */
    public static function pow($leftOperand, $rightOperand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcpow((string)$leftOperand, (string)$rightOperand);
        } else {
            return bcpow((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 对乘方结果进行取模
     * @param float|int|string $leftOperand  底数
     * @param int|string       $rightOperand 乘方
     * @param float|int|string $modulus       模
     * @param int|null         $scale         设置结果中小数点后的小数位数
     * @return string
     */
    public static function powmod($leftOperand, $rightOperand, $modulus, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcpowmod((string)$leftOperand, (string)$rightOperand, (string)$modulus);
        } else {
            return bcpowmod((string)$leftOperand, (string)$rightOperand, (string)$modulus, $scale);
        }
    }

    /**
     * 设置所有bc数学函数的默认小数点保留位数
     * @param int $scale 小数点保留位数.
     * @return bool 成功时返回 TRUE ， 或者在失败时返回 FALSE
     */
    public static function scale(int $scale): bool
    {
        return bcscale($scale);
    }

    /**
     * 任意精度数字的二次方根
     * @param float|int|string $operand 操作数
     * @param int|null         $scale   设置结果中小数点后的小数位数
     * @return string
     */
    public static function sqrt($operand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcsqrt((string)$operand);
        } else {
            return bcsqrt((string)$operand, $scale);
        }
    }

    /**
     * 2个任意精度数字的减法
     * @param float|int|string $leftOperand  被减数
     * @param float|int|string $rightOperand 减数
     * @param int|null         $scale         设置结果中小数点后的小数位数
     * @return string
     */
    public static function sub($leftOperand, $rightOperand, int $scale = null): string
    {
        if (is_null($scale)) {
            return bcsub((string)$leftOperand, (string)$rightOperand);
        } else {
            return bcsub((string)$leftOperand, (string)$rightOperand, $scale);
        }
    }

    /**
     * 任意个任意精度数字的减法
     * @param float|int|string $leftOperand   被减数
     * @param array            $right_operands 减数组成的数组
     * @param int|null         $scale          设置结果中小数点后的小数位数
     * @return string
     */
    public static function subs($leftOperand, array $right_operands, int $scale = null): string
    {
        $rightOperand = self::adds($right_operands, $scale);
        return self::sub($leftOperand, $rightOperand, $scale);
    }
}
