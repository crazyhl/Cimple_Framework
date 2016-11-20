<?php
namespace Cimple\Framework\Factory;
use Cimple\Framework\Config;
use Cimple\Framework\Response\TwigResponse;

/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-20
 * Time: 下午8:37
 */
class ResponseFactory
{
    public static function getInstance()
    {
        $template = Config::get('template', 'twig');
        $template = strtolower($template);

        switch ($template) {
            case 'twig':
                return new TwigResponse();
                break;
            default:
                http_response_code(404);
                echo "糟糕！我们目前还不支持你配置中的模板解析器哦";
                exit();
                break;
        }

    }

}