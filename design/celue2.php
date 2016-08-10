<?php
/**
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/18
 * Time: 21:35
 */
interface machine{
    function name();
    function make();
}

class computer implements machine{
    public function name(){
        echo 'i am computer'.'<br />';;
    }
    public function make(){
        echo 'I can make love'.'<br />';;
    }
}

class phone implements machine{
    public function name(){
        echo 'I am Iphone'.'<br />';;
    }
    public function make(){
        echo 'Camare yoursele'.'<br />';;
    }
}

class chose{
    public $machine;
    public function index(){
        $this->machine->name();
        $this->machine->make();
    }

    public function set($machine){
        $this->machine = $machine;
    }
}

$ms = new chose();
$ms->set(new phone());
$ms->index();