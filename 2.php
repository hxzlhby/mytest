<?php 
$merId = '8000000096';
$phones = '18612566761';
$size = '10';
$orderId = '201609201456001';
$backUrl = 'http://flow.hicardhome.com/index.php/Third/submitBack/p/II71D2FI6LWMQ949XSGZ3U9L';
$key = 'yN3HXKkRLIICEI3';

$res = md5($merId.'&'.$phones.'&'.$size.'&'.$orderId.'&'.$backUrl.'&'.$key);
echo $res;