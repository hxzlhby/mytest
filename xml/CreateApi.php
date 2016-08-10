<?php

/**
 * 策略模式的数据处理
 */
class CreateApi{
    public static function getData($obj='Json',$data=array()){
        return $obj::get($data);
    }
}
class Json{
    public static function get($result){
        return json_encode($result);
    }
}

/**
 * array转化为xml
 */
class Xml{
    public static function get($result){
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
$data['code'] = 200;
$data['success'] = true;
$data['list'] = array(
    'id'=>1,
    'name'=>'hxz',
    'info'=>array(
        1,2,3,4,5
    )
);
$res = CreateApi::getData('Xml',$data);
$xml = simplexml_load_string($res);
$newXml = $xml->asXML();
$fp = fopen('test02.xml','w');
fwrite($fp,$newXml);
fclose($fp);
var_dump($newXml);