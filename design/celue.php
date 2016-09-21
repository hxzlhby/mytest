<?php
//主类
class CD{
    protected $arr = array();
    public function __construct($data){
        $this->arr = $data;
    }
    
    public function getCd($obj){
        return $obj->get($this->arr);
    }
}
//定义接口类
interface data{
    function get($data);
}
//实现接口方式1
class Json implements data{
    public function get($data){
        echo '输出json数据';
        return json_encode($data);
    }
}
//实现接口方式2
class Xml implements data{
    public function get($result){
        $xml = '';
        header('Content-Type:text/xml');
        $xml .="<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .="<root>\n";
        $xml .=self::_buildXml($result);
        $xml .="</root>";
        return $xml;
    }
    private static function _buildXml($data){
        $xml = $code = '';
        foreach($data as $k=>$v){
            if(is_numeric($k)){
                $code = " id='{$k}'";
                $k ='item';
            }
            $xml .="<{$k}{$code}>";
            $xml .= is_array($v) ? self::_buildXml($v) : $v;
            $xml .="</{$k}>\n";
        }
        return $xml;
    }
}

$arr = array('name'=>'刘德华','data'=>array('title'=>'忘情水','year'=>'1998'));
$obj = new CD($arr);
$res = $obj->getCd(new Json());
var_dump($res);

