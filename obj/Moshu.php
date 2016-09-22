<?php 

class Moshu{
    public function __call($method, $arguments){
        var_dump($method);
        var_dump($arguments);
        var_dump(method_exists($this, $method));
    }
    
    public function say(){
        echo 'say';
    }
}
echo '<pre>';
$a = new Moshu();
$a->say(1,2,3);
