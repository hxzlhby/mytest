<?php
//var_dump(addslashes('He"ll\oNUL'));
//$str = 'hello .worlk.1.2.4';
//$token = strtok($str,'.');
//$string  =  "This is\tan example\nstring" ;
///* 使用制表符和换行符作为分界符 */
//$tok  =  strtok ( $string ,  " \n\t" );
//while ( $tok  !==  false ) {
//    echo  "Word= $tok <br />" ;
//    $tok  =  strtok ( " \n\t" );
//}
//$search = 'a';
//$search = array('b','c');
////$replace = 'h';
//$replace = array('x','z');
////$subject = 'ababcabdaeaf';
//$subject = array('a','b','c');
//var_dump($subject);
//$str = str_replace($search,$replace,$subject);
//var_dump($str);
//$str = '11012345678911';
//var_dump(substr_replace($str,'tihuan',6,3));
//var_dump(substr_count($str,'11'));
//var_dump(strstr($str,'12'));
//var_dump(strpos($str,'6'));
//var_dump(substr ( strrchr ( 'Line 1\nLine 2\nLine 3' ,  "i" ),  1 ));
//var_dump(strspn('26 is 88 and 11','0126122ds'));
//var_dump(strspn ( "42 is the answer to the 128th question." ,  "134567890" ));
//echo  strspn ( "foo" ,  "o" ,  0 ,  2 );  // 打印: 2
//var_dump(strcspn('a0b11',$str));
//var_dump(chunk_split($str,2));
$s1 = 's1';
$s2 = &$s1;
$s3 = $s1;
var_dump($s1,$s2,$s3);
$s1 = 's11';
var_dump($s1,$s2,$s3);

function test(){
    echo "1\n";
    function test2(){
        echo "2\n";
    }
    test2();
}
test();