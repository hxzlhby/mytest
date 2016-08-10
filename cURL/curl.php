<?php
$s1 = microtime();
$url = 'http://www.baidu.com';
$data = 'post的数据';
//1:curl初始化
$ch = curl_init();
//2:设置变量
curl_setopt($ch,CURLOPT_URL,$url);//设置访问页面的url
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//将curl_exec()获取的信息以文件流的形式返回,而不是直接输出
/*可选参数*/
curl_setopt($ch,CURLOPT_HEADER,0);//是否获取头信息
curl_setopt($ch,CURLOPT_TIMEOUT,30);//设置超时时间

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //https 对认证证书来源的检查从证书中检查SSL加密算法是否存在
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //https
//模拟登陆
date_default_timezone_set('PRC'); // 使用Cookie时，必须先设置时区
curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
curl_setopt($curlobj, CURLOPT_FOLLOWLOCATION, 1); // 这样能够让cURL支持页面链接跳转

curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json; charset=utf-8', 'Content-Length: ' . strlen($data))); //设置头信息,传输数据为json格式
curl_setopt ( $ch, CURLOPT_POST, 1 );//post方式
curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");//PUT方式
curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");//DELETE方式
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data);//post的数据
/*可选参数*/
//3:执行curl并获取结果
$output = curl_exec($ch);
if ($output === FALSE) {
    echo "cURL Error: " . curl_error($ch);
}
// 请注意，比较的时候我们用的是“=== FALSE”，而非“== FALSE”。因为我们得区分 空输出 和 布尔值FALSE，后者才是真正的错误。
//$info = curl_getinfo($ch);//获取信息.
//4:关闭curl
curl_close($ch);
$e1 = microtime();
echo $e1-$s1;
//var_dump($output);
$s2 = microtime();


include_once('../class/CurlMulti.class.php');
$urls = array('http://www.baidu.com');
$curl = new CurlMulti();
$data = $curl->curl($urls,'GET');
$e2 = microtime();
echo $e2-$s2;
//var_dump($data);

/**
 * 发送HTTP请求方法，目前只支持CURL发送请求
 * @param  string $url    请求URL
 * @param  array  $param  GET参数数组
 * @param  array  $data   POST的数据，GET请求时该参数无效
 * @param  string $method 请求方法GET/POST
 * @return array          响应数据
 */
function http($url, $param, $data = '', $method = 'GET'){
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    );

    /* 根据请求类型设置特定参数 */
    $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);

    if(strtoupper($method) == 'POST'){
        $opts[CURLOPT_POST] = 1;
        $opts[CURLOPT_POSTFIELDS] = $data;

        if(is_string($data)){ //发送JSON数据
            $opts[CURLOPT_HTTPHEADER] = array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data),
            );
        }
    }

    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    //发生错误，抛出异常
    if($error) throw new \Exception('请求发生错误：' . $error);

    return  $data;
}