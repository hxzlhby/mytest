<?php
//$info = new SplFileObject(__FILE__);
echo '<pre>';
//var_dump($info);
//var_dump($info->getPathname());
//foreach ( $info  as  $line_num  =>  $line ) {
//    echo  "Line  $line_num  is  $line " ;
//}
var_dump(basename(__FILE__));
var_dump(dirname(__FILE__));
var_dump(pathinfo(__FILE__,PATHINFO_EXTENSION));
$a=array("Cat","Dog","Horse","Dog");
print_r(array_count_values($a));
$input  = array( "Neo" ,  "Morpheus" ,  "Trinity" ,  "Cypher" ,  "Tank" );
$rand_keys  =  array_rand ( $input ,  2 );
var_dump($rand_keys);
