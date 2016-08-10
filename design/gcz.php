<?php
class GCZ{
    protected $OB = array();//放置观察者
    //添加观察者
    public function addOB($type,$OB){
        $this->OB[$type][] = $OB;
    }
    //运行观察者
    public function obServer($type){
        if(isset($this->OB[$type])){
            foreach ($this->OB[$type] as $obj) {
                $a = new $obj;
                $a->update($this);
            }
        }
    }
    //限制观察者方式
    public function create(){
        $this->obServer('buy');
    }
}
class Email{
    public function update(){
        echo '下单成功,发送邮件';
    }
}
class updateOrder{
    public function update(){
        echo '下单成功,更改订单状态';
    }
}
$od = new GCZ();
$od->addOB('buy','Email');
$od->create();