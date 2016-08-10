<?php
/**
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/18
 * Time: 23:00
 */
class json{
    public function getJsonData(){}
}
class xml{
    public function getXmlData(){}
}
//工厂类
class factory{
    public static function create($class){
        return new $class;
    }
}
factory::create('json')->getJsonData();