<?php
/**
 * array转化为xml
 */
class BuildXml{
    public static function arr2xml($data){
        $xml = new SimpleXMLElement('<root></root>');
        self::data2arr($xml,$data);
        return $xml->asXML();
    }
    /**
     * 数据XML编码
     * @param  object $xml  XML对象
     * @param  mixed  $data 数据
     * @param  string $item 数字索引时的节点名称
     * @return string
     */
    public static function data2arr($xml,$data,$item = 'item'){
        foreach ($data as $key => $value) {
            /* 指定默认的数字key */
            is_numeric($key) && $key = $item;
            /* 添加子元素 */
            if(is_array($value) || is_object($value)){
                $child = $xml->addChild($key);
                self::data2arr($child, $value, $item);
            } else {
                if(is_numeric($value)){
                    $child = $xml->addChild($key, $value);
                } else {
                    $child = $xml->addChild($key);
                    $node  = dom_import_simplexml($child);
                    $cdata = $node->ownerDocument->createCDATASection($value);
                    $node->appendChild($cdata);
                }
            }
        }
    }
}
$data['code'] = 200;
$data['success'] = true;
$data['list'] = array(
    'id'=>1,
    'name'=>'hxz',
);
echo '<pre>';
$str = BuildXml::arr2xml($data);
var_dump($str);
$xml = simplexml_load_string($str,'SimpleXMLElement', LIBXML_NOCDATA);
$json = json_encode($xml);
var_dump($json);
var_dump(json_decode($json,true));