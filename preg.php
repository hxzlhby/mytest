<?php
//$pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
//$subject = 'huang_.123.d@192.com.cc';
//$res1 = preg_match($pattern,$subject,$matches);
//preg_match_all($pattern,$subject,$matches);
//$replacement = '$1(replacement)$2$3';
//$res2 = preg_replace($pattern,$replacement,$subject);
$pattern = '/[0-9a-d]/';
//$pattern = array('/[0-1]/','/[2-3]/','/[a-e]/','/[f-g]/');
//$subject = '12huang34xia05678zhe9';
$subject = array('12huang','34xiao','5678','zhe');
$replacement = array('爱','买','春','燕');
//$res1 = preg_match($pattern,$subject,$matches1);
//$res2 = preg_match_all($pattern,$subject,$matches2);
//$res1 = preg_replace($pattern,$replacement,$subject);
//$res2 = preg_filter($pattern,$replacement,$subject);
$res3 = preg_grep($pattern,$subject);





echo '<pre>';
var_dump($res3);