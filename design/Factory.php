<?php
/**
* 工厂模式
* 提供获取某个对象实例的一个接口，同时使调用代码避免确定实例化基类的步骤。
* 工厂模式 实际上就是建立一个统一的类实例化的函数接口。统一调用，统一控制。
* 工厂模式是PHP项目开发中，最常用的设计模式，一般会配合单例模式一起使用，来加载php类库中的类。
* 
* 应用场景
* 我们拥有一个Json类，String类，Xml类。
* 如果我们不使用工厂方式实例化这些类，则需要每一个类都需要new一遍，过程不可控，类多了，到处都是new的身影
* 引进工厂模式，通过工厂统一创建对象实例。
*/
abstract class FactoryAbstract 
{
    protected static $instance = [];
    private function __construct() {}
    private function __clone() {}
    
    public static function getInstance()
    {
        $className = static::getClassName();
        if (!(self::$instance[$className] instanceof $className)){
            self::$instance[$className] = new $className();
        }
        return self::$instance[$className];
    }
    
    public static function removeInstance()
    {
        $className = self::getClassName();
        if (array_key_exists($className, self::$instance)){
            unset(self::$instance[$className]);
        }
    }
    
    final protected function getClassName()
    {
        return get_called_class();//获取静态绑定后的类名
    }
}

abstract class Factory extends FactoryAbstract
{
    public static function getInstance() 
    {
        return parent::getInstance();
    }
    public static function removeInstance()
    {
        return parent::removeInstance();
    }
}

class Test1 extends Factory
{
    public $a = [];
}
class Test2 extends Test1{}

Test1::getInstance()->a[] = 1;
Test2::getInstance()->a[] = 2;
Test1::getInstance()->a[] = 3;
Test2::getInstance()->a[] = 4;
var_dump(Test1::getInstance()->a);
var_dump(Test2::getInstance()->a);