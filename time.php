<?php
date_default_timezone_set('PRC');
echo '<pre>';
//$obj_time = new DateTime();
//$obj_time->setTimezone(new DateTimeZone('PRC'));
//echo $obj_time->format('Y-m-d H:i:s')."\n";
//echo '<hr />';
//var_dump(DateTime::createFromFormat('Y-m-d','-1 day'));
//echo '<hr />';
//$obj_time2 = new DateTime();
//echo $obj_time2->format('Y-m-d H:i:s')."\n";
//echo '<hr />';
//echo date('Y-m-d H:i:s',time())."\n";
//echo '<hr />';
//echo date('Y-m-d H:i:s',strtotime("-1 day"))."\n";
//echo '<hr />';
//echo  date('Y-m-d H:i:s',strtotime ( "+1 day" )),  "\n" ;
//echo '<hr />';
//var_dump((string)microtime(true));
var_dump ( filter_var ( 'b \no b@example.com' ,  FILTER_VALIDATE_EMAIL ));
var_dump ( filter_var ( 'http://example.com' ,  FILTER_VALIDATE_URL ));
echo '<hr />';
var_dump ( filter_var ( 'b \no b@example.com' ,  FILTER_SANITIZE_EMAIL  ));
var_dump ( filter_var ( 'http://example.com' ,  FILTER_SANITIZE_URL  ));
print_r ( filter_list ());
$data = array('email'=>'b1no2b@example.com','url'=>'http://example.com');
$args = array('email'=>FILTER_VALIDATE_EMAIL,'url'=>FILTER_SANITIZE_URL);
var_dump(filter_var_array($data,$args));
