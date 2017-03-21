<?php
/**
* 观察者模式
* 能够更便利创建和查看目标对象状态的对象, 并且提供和核心对象非耦合的置顶功能性。
* 非常常用,在一般复杂的WEB系统中,可以帮你减轻代码设计的压力,降低代码耦合
* 
* 场景设计
* 1 设计一个订单类
* 2 订单创建完成后,会做各种动作,比如发送EMAIL,或者改变订单状态等等。
* 3 原始的方法,是将这些操作都写在create函数里面
* 4 但是随着订单创建类的越来越庞大,这样的操作已经无法满足需求和快速变动
* 5 这个时候,观察者模式出现了。
*/
class Order
{
    protected $observers = [];//存放观察者
    //观察者新增
    public function addObservers($type,$observer) 
    {
        $this->observers[$type][] = $observer;
    }
    //运行观察者
    public function observer($type) 
    {
        if(isset($this->observers[$type])){
            foreach ($this->observers[$type] as $obser){
                $a = new $obser;
                $a->update();
            }
        }
    }
    //下单购买流程
    public function create() 
    {
        echo '购买成功';
        $this->observer('buy');//buy动作
    }
}
class OrderEmail
{
    public function update() 
    {
        echo '发送邮件';
    }
}
class OrderMessage
{
    public function update()
    {
        echo '发送短信';
    }
}
$order = new Order();
$order->addObservers('buy', 'OrderEmail');
$order->addObservers('buy', 'OrderMessage');
$order->create();
