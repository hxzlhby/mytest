<?php
/**
 * 通过提供自身共享实例的访问，单例设计模式用于限制特定对象只能被创建一次。
 * 使用场景
 * 例如数据库实例，一般都会走单例模式。
 * 单例模式可以减少类的实例化
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/18
 * Time: 21:54
 */

class Danli{
    private static $instance;
    private function __construct(){}
    public static function getinstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self;
        }
        echo 111;
        return self::$instance;
    }
}

$a = Danli::getinstance();
var_dump($a);