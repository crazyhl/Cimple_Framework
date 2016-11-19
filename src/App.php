<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-19
 * Time: 下午6:24
 */

namespace Cimple\Framework;

use Cimple\Framework\Utils\StringUtils;

include 'Define.php';

class App
{
    // 路径信息
    protected $urlInfo;
    // 模块信息
    protected $module;
    // 模块内的请求路径
    protected $requestPath;
    // 请求方式
    protected $requestMethod;

    /**
     * 启动app
     */
    public function run()
    {
        // 歇息路径信息

        $this->parseUrl();
        // 解析url分析模块以及解析路由
        $this->parseRequest();
        // 加载配置项
        $this->loadConfig();
        Config::set('test.xxx.a', [
            'a' => '1',
            'b' => '1',
            'c' => '1',
            'd' => '1',
        ]);

        echo '<pre>';
        var_dump($_SERVER);
        var_dump(Config::get());
        var_dump($this->requestMethod);
        echo '</pre>';
    }

    /**
     * 载入系统以及应用配置文件
     */
    private function loadConfig()
    {
        // 加载项目通用配置
        $applicationConfigFileName = ROOT_PATH . 'Config.php';
        if (file_exists($applicationConfigFileName)) {
            Config::set('', array_change_key_case(include $applicationConfigFileName));
        }
        $moduleConfigFileName = ROOT_PATH . Config::get('application_name') . DS . $this->module . DS . 'Config.php';
        if (file_exists($moduleConfigFileName)) {
            Config::set('', array_change_key_case(include $moduleConfigFileName));
        }
    }

    /**
     * 解析url信息
     */
    private function parseUrl()
    {
        $this->urlInfo = parse_url($_SERVER['REQUEST_URI']);
    }

    /**
     * 解析请求信息
     */
    private function parseRequest()
    {
        $this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if (StringUtils::startWith($this->urlInfo['path'], '/index.php')) {
            $this->urlInfo['path'] = substr($this->urlInfo['path'], 10);
        }
        $this->urlInfo['path'] = substr($this->urlInfo['path'], 1);
        $this->requestPath = '/';
        if (empty($this->urlInfo['path'])) {
            $this->module = $this->config['default_module'];
        } else {
            $splashIndex = strpos($this->urlInfo['path'], '/');
            if ($splashIndex === false) {
                $this->module = $this->urlInfo['path'];
            } else {
                $this->module = substr($this->urlInfo['path'], 0, $splashIndex);
                $this->requestPath = substr($this->urlInfo['path'], $splashIndex);

            }
        }
        $this->module = ucwords($this->module);
    }

}