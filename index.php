<?php
function autoload($class){
    include_once(__DIR__.'/class/'.$class.'.class.php');
}
spl_autoload_register('autoload');
$db = EasyDB::getInstance();
$where['username'] = 'test';
$where['id'] = 1;
$res1 = $db->table('user')->filed('id,username')->where($where)->find();
$options = $db->options;
$sql = $db->sql;
dump($options);
dump($sql);
dump($res1);





























function dump($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
/*use \cs1;
use \cs2;
require_once('cs1.php');
require_once('cs2.php');
cs1\test();//命名空间
cs2\test();

$a = new cs1\cs();
$a->test();*/
//$start = microtime();
//require_once('PasswordHash.php');
//$pass = new PasswordHash(2,false);
//$pass1 = $pass->HashPassword('111');
//$res1 = $pass->CheckPassword('1121',$pass1);
//$end = microtime();
//echo $end-$start;
//var_dump($pass1);
//var_dump($res1);