<?php
function autoload($class){
    include_once(__DIR__.'/class/'.$class.'.class.php');
}
spl_autoload_register('autoload');
$curl = new CurlMulti();
$urls = array('http://localhost/liveclass/course/delay/callback_info','http://localhost/liveclass/course/delay/callback_info','http://localhost/liveclass/course/delay/callback_info');
$data['co_id'] = 3744;
$res = json_encode($data);
$val = $curl->curl($urls,'POST',$data);
$val2 = $curl->curl($urls,'POST',$res);
echo '<pre>';
var_dump($val,$val2);