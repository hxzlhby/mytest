<?php
/**
* 单例模式
* 通过提供自身共享实例的访问，单例设计模式用于限制特定对象只能被创建一次。
* 
* 使用场景
* 1 例如数据库实例，一般都会走单例模式。
* 2 单例模式可以减少类的实例化
*/
class DB
{
    private static $instance;
    private function __construct() {}
    private function __clone() {}
    public static function getInstance() 
    {
        if (!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }
}