<?php
echo '<pre>';
$str = file_get_contents('test1.xml');
//header("Content-Type:text/xml");
//var_dump($str);
$xml = new SimpleXMLElement($str);
//var_dump($xml);
function xml2arr($xml){
    $res = array();
    foreach($xml as $key=>$value){
        var_dump($value);
//        var_dump(strval($value));
        $res[$key] = strval($value);
    }
    return $res;
}
$res = xml2arr($xml);
//var_dump($res);
//$xml = simplexml_load_file('test1.xml');
//var_dump($xml);
//$xml = simplexml_load_string($str,'SimpleXMLElement', LIBXML_NOCDATA);
//$json = json_encode($xml);
//var_dump($json);
//var_dump(json_decode($json,true));
//echo $newXml = $xml->asXML();
//$fp = fopen('test01.xml','w');
//fwrite($fp,$newXml);
//fclose($fp);

/**
 * Class MyDOMDocument
 * xml转化为array
 */
/*class MyDOMDocument extends DOMDocument
{
    public function toArray(DOMNode $oDomNode = null)
    {
        // return empty array if dom is blank
        if (is_null($oDomNode) && !$this->hasChildNodes()) {
            return array();
        }
        $oDomNode = (is_null($oDomNode)) ? $this->documentElement : $oDomNode;
        if (!$oDomNode->hasChildNodes()) {
            $mResult = $oDomNode->nodeValue;
        } else {
            $mResult = array();
            foreach ($oDomNode->childNodes as $oChildNode) {
                // how many of these child nodes do we have?
                // this will give us a clue as to what the result structure should be
                $oChildNodeList = $oDomNode->getElementsByTagName($oChildNode->nodeName);
                $iChildCount = 0;
                // there are x number of childs in this node that have the same tag name
                // however, we are only interested in the # of siblings with the same tag name
                foreach ($oChildNodeList as $oNode) {
                    if ($oNode->parentNode->isSameNode($oChildNode->parentNode)) {
                        $iChildCount++;
                    }
                }
                $mValue = $this->toArray($oChildNode);
                $sKey   = ($oChildNode->nodeName{0} == '#') ? 0 : $oChildNode->nodeName;
                $mValue = is_array($mValue) ? $mValue[$oChildNode->nodeName] : $mValue;
                // how many of thse child nodes do we have?
                if ($iChildCount > 1) {  // more than 1 child - make numeric array
                    $mResult[$sKey][] = $mValue;
                } else {
                    $mResult[$sKey] = $mValue;
                }
            }
            // if the child is <foo>bar</foo>, the result will be array(bar)
            // make the result just 'bar'
            if (count($mResult) == 1 && isset($mResult[0]) && !is_array($mResult[0])) {
                $mResult = $mResult[0];
            }
        }
        // get our attributes if we have any
        $arAttributes = array();
        if ($oDomNode->hasAttributes()) {
            foreach ($oDomNode->attributes as $sAttrName=>$oAttrNode) {
                // retain namespace prefixes
                $arAttributes["@{$oAttrNode->nodeName}"] = $oAttrNode->nodeValue;
            }
        }
        // check for namespace attribute - Namespaces will not show up in the attributes list
        if ($oDomNode instanceof DOMElement && $oDomNode->getAttribute('xmlns')) {
            $arAttributes["@xmlns"] = $oDomNode->getAttribute('xmlns');
        }
        if (count($arAttributes)) {
            if (!is_array($mResult)) {
                $mResult = (trim($mResult)) ? array($mResult) : array();
            }
            $mResult = array_merge($mResult, $arAttributes);
        }
        $arResult = array($oDomNode->nodeName=>$mResult);
        return $arResult;
    }
}
$dom = new MyDOMDocument();
$dom->load('test1.xml');
$arr = $dom->toArray($dom);
var_dump($arr);*/