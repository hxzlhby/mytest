<?php
/**
 * 观察者模式
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/18
 * Time: 22:20
 */
class order{
    protected $observers = array();//存放观察者
    //新增观察者
    public function addObServer($type,$observer){
        $this->observers[$type][] = $observer;
    }
    //运行观察者
    public function obServer($type){
        if(isset($this->observers[$type])){
            foreach($this->observers[$type] as $k){
                $a = new $k;
                $a->update($this);//公用方法
            }
        }
    }
    //下单购买流程
    public function create(){
        echo '购买成功<br />';
        $this->obServer('buy');//buy动作
    }
}
class orderEmai{
    public static function update($order){
        echo '发送购买成功的一个邮件<br />';
    }
}
class orderStatus{
    public static function update($order){
        echo '改变订单状态<br />';
    }
}
$or = new order();
$or->addObServer('buy','orderEmai');
//$or->addObServer('buy','orderStatus');
$or->create();
