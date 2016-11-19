<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午6:24
 */

namespace Cimple\Framework;


class App
{
    protected  $config;
    /**
     * 启动app
     */
    public function run()
    {
        $this->config = $this->loadConfig();
    }

    /**
     * 载入配置文件
     */
    protected function loadConfig()
    {
    }
}