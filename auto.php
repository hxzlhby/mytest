<?php
/**
 * 自动加载
 * spl_autoload_register('自定义函数名')
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/20
 * Time: 10:00
 */

function autoload($className){
    include_once($className.'.php');
}
spl_autoload_register('autoload');//注册自定义自动加载函数
Danli::getinstance();