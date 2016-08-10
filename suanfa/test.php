<?php
$arr = array(0,49,21,4,66,21,9,4,16,25,36,24);
echo '<pre>';
function bubble($arr){
    $n = count($arr);
    if($n<=1) return $arr;
    /*构建相邻的两个元素*/
    for($i=0;$i<$n-1;$i++){
        for($j=$i;$j<$n-1;$j++){
            /*比较并交换*/
            if($arr[$i] > $arr[$j+1]){
                list($arr[$i],$arr[$j+1]) = array($arr[$j+1],$arr[$i]);
            }
        }
    }
    return $arr;
}
//$res = bubble($arr);
function insertion($arr){
    $n = count($arr);
    if($n<=1) return $arr;
    for($i=1;$i<$n;$i++){
        /*后面的元素与前面已排序的比较*/
        if($arr[$i] < $arr[$i-1]){
            $t = $arr[$i];//取小值
            /**/
            for($j=$i-1;$j>=0 && $arr[$j]>$t;$j--){
                $arr[$j+1] = $arr[$j];
            }
            $arr[$j+1] = $t;
        }
    }
    return $arr;
}
//$res = insertion($arr);
function shell($arr){
    $n = count($arr);
    if($n<=1) return $arr;
    $array = array(41,19,5,1);
    for($i=0,$h=count($array);$i<$h;$i++){
        $grep = $array[$i];
        for($j=$grep;$j<$n;$j++){
            $t=$arr[$j];
            for($k=$j-$grep;$k>=0 && $arr[$k]>$t;$k-=$grep){
                $arr[$k+$grep] = $arr[$k];
            }
            $arr[$k+$grep] = $t;
        }
    }
    return $arr;
}
$res = shell($arr);
function selection($arr){
    $n = count($arr);
    if($n<=1) return $arr;
    for($i=0;$i<$n;$i++){
        $t=$i;//假设最小值
        for($j=$i+1;$j<$n;$j++){
            /*大于后一位,设置其为参考值*/
            if($arr[$t]>$arr[$j]){
                $t=$j;
            }
        }
        /*判断假设的值是否改变*/
        if($t!=$i){
            list($arr[$i],$arr[$t]) = array($arr[$t],$arr[$i]);
        }
    }
    return $arr;
}
//$res = selection($arr);
function quick($arr){
    $n = count($arr);
    if($n<=1) return $arr;
    $k=$arr[0];
    $l=$r=array();
    for($i=1;$i<$n;$i++){
        if($arr[$i]<=$k)
            $l[]=$arr[$i];
        else
            $r[]=$arr[$i];
    }
    $l=quick($l);
    $r=quick($r);
    return array_merge($l,array($k),$r);
}
//$res = quick($arr);

print_r($res);