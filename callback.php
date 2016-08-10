<?php
error_reporting(E_ALL);
function callback($type){
    echo $type;
}
call_user_func('callback','call_user_func');
call_user_func_array('callback',array('call_user_func_array'));

function foo(){
    $num = func_num_args();
    $arg1 = func_get_arg(1);
    $arr = func_get_args();
    var_dump($num,$arg1,$arr);
}
foo(0,1,2,3,'a');