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
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance instanceof Request) {
            return self::$instance;
        }
        self::$instance = new Request();
        return self::$instance;
    }

    public function getRequestMethod()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        return $method;
    }

    public function isGet()
    {
        $method = self::getRequestMethod();
        return $method == 'get';
    }

    public function isPost()
    {
        $method = self::getRequestMethod();
        return $method == 'post';
    }

    public function get($name, $defaultValue)
    {
        return self::input($_GET, $name, $defaultValue);
    }

    public function post($name, $defaultValue)
    {
        return self::input($_POST, $name, $defaultValue);
    }

    public function input($data, $name, $defaultValue)
    {
        static $valArr = [];
        if ($valArr[$name]) {
            return $valArr[$name];
        }
        if (!empty($data) && is_array($data)) {
            if ($data[$name]) {
                $value = htmlspecialchars($data[$name]);
                $valArr = $value;
                return $value;
            }
        }
        return $defaultValue;
    }
}