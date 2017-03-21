<?php
/**
* 注册树模式
* 并不是很常见
* 只是为了利用静态方法更方便的存取数据。
*/
class Registry
{
    protected static $obj = [];
    public static function setObj($key,$val) 
    {
        self::$obj[$key] = $val;
    }
    
    public static function getObj($key) 
    {
        return isset(self::$obj[$key]) ? self::$obj[$key] : null;
    }
    final public static function removeObj($key) 
    {
        if (array_key_exists($key, self::$obj)){
            unset(self::$obj[$key]);
        }
    }
}
Registry::setObj('name', 'Package name');
var_dump(Registry::getObj('name'));
//Package name