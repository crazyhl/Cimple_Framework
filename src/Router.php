<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午10:39
 */

namespace Cimple\Framework;


class Router
{
    private static $route = [];

    public static function route($method, $url, $func)
    {
        if (is_array($method)) {
            foreach ($method as $m) {
                $m = trim($m);
                self::$route[$m][$url] = $func;
            }
        } else {
            self::$route[$method][$url] = $func;
        }
    }

    public static function get($url, $func)
    {
        self::route('get', $url, $func);
    }

    public static function post($url, $func)
    {
        self::route('post', $url, $func);

    }

    public static function put($url, $func)
    {
        self::route('patch', $url, $func);

    }

    public static function patch($url, $func)
    {
        self::route('patch', $url, $func);

    }

    public static function delete($url, $func)
    {
        self::route('delete', $url, $func);

    }

    public static function any($url, $func)
    {
        self::route(['get', 'post', 'patch', 'delete'], $url, $func);
    }

    public static function getRequestByMethod($method) {
        return self::$route[$method];
    }
}