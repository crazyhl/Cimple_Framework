<?php
/**
 * Created by PhpStorm.
 * User: chrishao
 * Date: 16-11-20
 * Time: 下午8:42
 */

namespace Cimple\Framework\Response;


use Cimple\Framework\Config;
use Psr\Http\Message\MessageInterface;

abstract class Response implements MessageInterface
{
    protected $templateDir;
    protected $data = [];

    public function __construct()
    {
        $this->templateDir = ROOT_PATH . Config::get('application_name') . DS . Config::get('module_path') . DS . Config::get('template_dir', 'template');
    }

    public function add($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render($template, $data = [])
    {
    }

    public function load($templateName)
    {
    }
}