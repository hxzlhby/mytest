<?php
date_default_timezone_set('PRC');
$url = 'http://redmine.chinese.cn/redmine/login';
$data = 'username=huangxiaozhe&password=123456';
$ch = curl_init();//1,初始化
curl_setopt($ch,CURLOPT_URL,$url);//设置url
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_COOKIESESSION,true);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 这样能够让cURL支持页面链接跳转
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // https 对认证证书来源的检查从证书中检查SSL加密算法是否存在
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //https
curl_setopt($ch,CURLOPT_HTTPHEADER,array("application/x-www-form-urlencoded; charset=utf-8","Content-length: ".strlen($data)));
curl_exec($ch);
curl_setopt($ch,CURLOPT_URL,'http://redmine.chinese.cn/redmine');
curl_setopt($ch,CURLOPT_POST,0);
curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-type=text/xml"));
$opt = curl_redir_exec($ch);
curl_close($ch);
var_dump($opt);

/**
 * 自定义实现页面链接跳转抓取
 */
function curl_redir_exec($ch,$debug="")
{
    static $curl_loops = 0;
    static $curl_max_loops = 20;

    if ($curl_loops++ >= $curl_max_loops)
    {
        $curl_loops = 0;
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HEADER, true); // 开启header才能够抓取到重定向到的新URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    // 分割返回的内容
    $h_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($data,0,$h_len);
    $data = substr($data,$h_len - 1);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code == 301 || $http_code == 302) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = @parse_url(trim(array_pop($matches)));
        // print_r($url);
        if (!$url)
        {
            //couldn't process the url to redirect to
            $curl_loops = 0;
            return $data;
        }
        $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
        if (!isset($url['scheme']))
            $url['scheme'] = $last_url['scheme'];
        if (!isset($url['host']))
            $url['host'] = $last_url['host'];
        if (!isset($url['path']))
            $url['path'] = $last_url['path'];

        $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . (isset($url['query'])?'?'.$url['query']:'');
        curl_setopt($ch, CURLOPT_URL, $new_url);

        return curl_redir_exec($ch);
    } else {
        $curl_loops=0;
        return $data;
    }
}