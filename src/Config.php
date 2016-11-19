<?php
/**
 * 系统默认配置项
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午7:13
 */
namespace Cimple\Framework;

class Config
{
    private static $config = [
        'default_module' => 'Home',
        'application_name' => 'App',
    ];

    public static function set($name, $value)
    {
        if (empty($value)) {
            return;
        }

        if (empty($name) && is_array($value)) {
            self::$config = array_merge(self::$config, $value);
        }
        if ($name) {
            $nameArr = explode('.', $name);
            $putName = &self::$config;
            foreach ($nameArr as $n) {
                if (empty($putName[$n])) {
                    $putName[$n] = [];
                }
                $putName = &$putName[$n];
            }
            if (is_array($value)) {
                $value = array_merge($putName, $value);
            }
            $putName = $value;
        }
    }

    public static function get($name, $defalutValue)
    {
        if (empty($name)) {
            return self::$config;
        }
        $nameArr = explode('.', $name);
        $getName = null;
        foreach ($nameArr as $n) {
            $getName = self::$config[$n];
        }
        if ($getName) {
            return $getName;
        }
        return $defalutValue;
    }

}
