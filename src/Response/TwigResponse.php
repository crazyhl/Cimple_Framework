<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-20
 * Time: 下午8:21
 */

namespace Cimple\Framework\Response;
use Cimple\Framework\Config;


/**
 * 响应类
 * Class Response
 * @package Cimple\Framework
 */
class TwigResponse extends Response
{

    public function __construct()
    {
        parent::__construct();

    }

    public function render($template, $data = [])
    {
    }

    public function load($templateName)
    {
    }
}