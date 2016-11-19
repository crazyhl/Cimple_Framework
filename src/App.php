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
    protected $urlInfo;
    /**
     * 启动app
     */
    public function run()
    {
        var_dump($_SERVER);
//        $this->urlInfo = parse_url();
//        $this->config = $this->loadConfig();
    }

    /**
     * 载入配置文件
     */
    protected function loadConfig()
    {
        var_dump(__NAMESPACE__);
    }
}