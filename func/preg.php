<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/10/28
 * Time: 15:42
 */
$str = 'bunditpns@hotmail.com';
$str = 'hxz-w+w.slhby@163.c-o-m.cn';
$pattern = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
$res = preg_match($pattern,$str);
$res2 = filter_var($str,FILTER_VALIDATE_EMAIL);
var_dump($res,$res2);