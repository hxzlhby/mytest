<?php
class OB{
    protected $observers = array();//1初始化观察者
    //2添加观察者
    public function addObserver($type,$action){
        $this->observers[$type][] = $action;
    }
    //3运行观察者
    public function observer($type){
        if(isset($this->observers[$type])){
            foreach($this->observers[$type] as $observer){
                $ob = new $observer;
                $ob->update();//设置公共方法
            }
        }
    }
    //设置$type的规范
    public function create(){
        echo '运行成功';
        $this->observer('buy');
    }
}
//观察者类
class Email{
    public function update(){
        echo '购买成功,发送邮件';
    }
}
class Exp{
    public function update(){
        echo '购买成功,积分+10';
    }
}
$user = new OB();
$user->addObserver('buy','Email');
$user->addObserver('buy','Exp');
$user->create();