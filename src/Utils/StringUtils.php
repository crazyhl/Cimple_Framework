<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午8:04
 */

namespace Cimple\Framework\Utils;


class StringUtils
{
    /**
     * 是否以制定字符串开头
     * @param $string
     * @param $pattern
     * @return bool
     */
    public static function startWith($string, $pattern)
    {
        return strpos($string, $pattern) === 0 ? true : false;
    }
}