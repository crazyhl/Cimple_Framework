<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午10:36
 */

namespace Cimple\Framework;


class Request
{
    public static function getRequestMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        return $method;
    }

    public static function isGet()
    {
        $method = self::getRequestMethod();
        return $method == 'get';
    }

    public static function isPost()
    {
        $method = self::getRequestMethod();
        return $method == 'post';
    }
}