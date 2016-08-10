<?php
$array = array(18,6,9,12,17,115,41,181,3,12,33,22,52,44,212,90);
/**
 * 快速排序
 * @param $array
 * @return array
 */
function quick($array){
    $count = count($array);
    if($count <= 1)	return $array;
    $key = $array[0];//以$key为界,分开数组
    $l = $r = array();//初始化
    for ($i=1; $i < $count; $i++) {
        if ($array[$i] <= $key)
            $l[] = $array[$i];
        else
            $r[] = $array[$i];
    }
    //分别进行递归排序,然后合并
    $l = quick($l);
    $r = quick($r);
    return array_merge($l,array($key),$r);
}

/**
 * 冒泡排序
 * 重复访问要排序的数列，每一次比较两个元素，如果前一个大于后一个元素，则交换数据
 * @param $array
 * @return mixed
 */
function bubble($array){
    $n = count($array);
    if($n <= 1) return $array;
    //构造相临的2个元素
    for ($i=0; $i < $n-1; $i++) {
        for ($j=$i; $j < $n-1; $j++) {
            //比较相临的2个元素的值,交换区间
            if ($array[$i] > $array[$j+1]) {
                $t = $array[$i];
                $array[$i] = $array[$j+1];
                $array[$j+1] = $t;
//                list($array[$i],$array[$j+1]) = array($array[$j+1],$array[$i]);
            }
        }
    }
    return $array;
}

/**
 * 插入排序
 * @param $array
 * @return mixed
 */
function insertion($array){
    $n = count($array);
    if($n <= 1)	return $array;
    for($i=1;$i<$n;$i++){
        //内层循环控制,比较并插入
        if($array[$i] < $array[$i-1]){
            $t = $array[$i];//取小的值
            //发现插入的元素要小,交换位置
            for($j=$i-1;($j>=0) && $array[$j]>$t;$j--){
                $array[$j+1] = $array[$j];//与后面的元素互换
            }
            $array[$j+1] = $t;
        }
    }
    return $array;
}

/**
 * 选择排序
 * @param $array
 * @return mixed
 */
function selection($array){
    $n = count($array);
    if($n <= 1)	return $array;
    for($i=0;$i<$n;$i++){
        $t = $i;//先假设最小值的位置
        for($j=$i+1;$j<$n;$j++){//指针移一位
            if($array[$t] > $array[$j]){//比假设的最小值小,设此为最小值
                $t = $j;
            }
        }
        if($t != $i){//假设的最小值不是最小,交换位置
            list($array[$i],$array[$t]) = array($array[$t],$array[$i]);;
        }
    }
    return $array;
}

/**
 * 希尔排序
 * @param $array
 * @return mixed
 */
function shell(&$array){
    $n = count($array);
    if($n <= 1)	return $array;
    //确定增量序列
    //php内没有整除 采用floor向下去整
    $sequence = array(41, 19, 5 ,1);//设置序列，可以换成别的序列
//    for($grep=floor($n/2);$grep>0;$grep=floor($grep/2)){
    for($k=0,$leng=count($sequence);$k<$leng;$k++){
        $grep = $sequence[$k];
        //内部实现与插入排序类似
        //不过比较的元素取决于增量
        for($i=$grep;$i<$n;$i++){
            $t = $array[$i];
            for($j=$i-$grep;$j>=0 && $array[$j]>$t;$j-=$grep){
                $array[$j+$grep] = $array[$j];
            }
            $array[$j+$grep] = $t;
        }
    }
    return $array;
}
/**
 * 归并操作
 * @param $l
 * @param $r
 * @return array
 */
function al_merge($l,$r){
    $min = array();//定义第三方数组
    //不断判断大小,把小的值给$min
    while(count($l) && count($r)){
        $min[] = $l[0] < $r[0] ? array_shift($l) : array_shift($r);
    }
    return array_merge($min,$l,$r);
}
/**
 * 归并排序
 * @param $array
 * @return array
 */
function merge($array){
    $n = count($array);
    if($n <= 1) return $array;//递归结束条件
    $mid = floor($n/2);//取数组中间,php没有整除,采用floor向下取整
    $l = array_slice($array,0,$mid);//拆分数组取左边到中间的部分
    $r = array_slice($array,$mid);//拆分数组,去中间到最后
    //递归合并,往上走
    $l = merge($l);
    $r = merge($r);
    $array = al_merge($l,$r);//合并2个数组,继续递归
    return $array;
}

/**
 * 二分查找法
 * 必须采用顺序结构
 * 必须按关键字大小有序排列
 * @param string $search
 * @param array $subject
 * @return float|int
 */
function binary_search($search='',$subject=array()){
    $n = count($subject);
    $low = 0;
    $high = $n-1;
    while ($low <= $high) {
        $mid = floor(($low+$high)/2);
        if($subject[$mid] == $search) return $mid;//找到元素
        if($subject[$mid] > $search) $high = $mid-1;//中元素比目标元素大,查找下部
        if($subject[$mid] < $search) $low = $mid+1;//中元素比目标小,查找上部
    }
    return -1;//查找失败
}



$array = array(1, 3, 5, 7, 9, 11);
$array = array(11, 9, 7, 5, 3, 1);
$res = binary_search(7,$array);
dump($res);

dump($array);
function dump($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
