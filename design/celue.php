<?php
/**
 * 策略模式
 * 策略模式设计帮助构建的对象不必自身包含逻辑，而是能够根据需要利用其他对象中的算法。
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/18
 * Time: 21:21
 */
class CD{
    protected $arr = array();
    public function __construct($title,$author){
        $this->arr['title'] = $title;
        $this->arr['author'] = $author;
    }
    public function getInfo($obj){
        return $obj->get($this->arr);
    }
}
class XML{
    public function get($data){
        echo '输出xml数据';
    }
}
class JSON{
    public function get($data){
        echo '输出json数据';
    }
}
$cd = new CD('朋友','周华健');
$cd->getInfo(new XML());