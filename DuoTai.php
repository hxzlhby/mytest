<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/20
 * Time: 16:40
 */
interface DuoTai{
    public function say();
    public function eat();
    public function wear();
}
class Person implements DuoTai{
    public $name;
    public function say(){
        echo $this->name.'说汉语';
    }
    public function eat(){
        echo $this->name.'吃中餐';
    }
    public function wear(){
        echo $this->name.'穿中式西服';
    }
}
$america = new Person();
$america->name = 'American';
$chinese = new Person();
$chinese->name = 'Chinese';
class Dt{
    private $obj;
    public function __construct($object){
        $this->obj = $object;
    }
    public function useSay(){
        $this->obj->say();
    }
    public function useEat(){
        $this->obj->eat();
    }
    public function useWear(){
        $this->obj->wear();
    }
}
$dt = new Dt($america);
$dt->useEat();