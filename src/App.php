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
    private $urlInfo;
    // 模块信息
    private $module;
    // 模块内的请求路径
    private $requestPath;
    // request
    private $request;
    // response
    private $response;

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance() {
        if (self::$instance instanceof App) {
            return self::$instance;
        }
        self::$instance = new App();
        return self::$instance;
    }

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
        // 配置一些东西
        $this->request = Request::getInstance();
        // 处理请求
        $this->dispatch();

        echo '<pre>';
        var_dump($_SERVER);
        var_dump(Config::get());
        var_dump($this->module);
        var_dump($this->requestPath);
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
        if (StringUtils::startWith($this->urlInfo['path'], '/index.php')) {
            $this->urlInfo['path'] = substr($this->urlInfo['path'], 10);
        }
        $this->urlInfo['path'] = substr($this->urlInfo['path'], 1);
        $this->requestPath = '/';
        if (empty($this->urlInfo['path'])) {
            $this->module = Config::get('default_module');
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

    /**
     * 分发处理请求
     */
    private function dispatch()
    {
        // 载入模块下的路由文件表
        $moduleRouteFileName = ROOT_PATH . Config::get('application_name') . DS . $this->module . DS . 'Route.php';
        if (!file_exists($moduleRouteFileName)) {
            echo $moduleRouteFileName . " 没找到路由文件哦！";
            exit();
        }
        include $moduleRouteFileName;

        $routeArr = Router::getRequestByMethod($this->request->getRequestMethod());
        $requestUrlArr= array_keys($routeArr);
        foreach ($requestUrlArr as $reqUrl) {
            if (preg_match('#^' . $reqUrl . '$#', $this->requestPath, $ms)) {
                $func = $routeArr[$reqUrl];
                unset($ms[0]);
                if (is_callable($func)) {
                    return call_user_func_array($func, array_values($ms));
                }
                return;
            }
        }
        echo $this->requestPath . " 路由表里面没有这个方法哦！";
        exit();
    }

}