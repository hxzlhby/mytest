<?php
/**
 * Created by PhpStorm.
 * User: 孝哲
 * Date: 2015/9/22
 * Time: 20:47
 */
echo '<pre>';
var_dump(date('Y-m-d H:i:s',time()));

$date = new DateTime();//实例化
$date->setTimezone(new DateTimeZone('Asia/Shanghai'));//设置时区==date_tmezone_set();
echo  $date -> getTimestamp();

$now = $date->format('Y:m:d H:i:s');//==date('Y-m-d H:i:s',time());参数U转换为unix时间戳
$now = $date->format('U');//==time()
var_dump($now);
$date->add(new DateInterval('P10D'));
var_dump($date->format('U'));
var_dump($date->format(DateTime::ATOM));
var_dump(date('Y-m-d H:i:s',time()));
var_dump(DateTime::ATOM);