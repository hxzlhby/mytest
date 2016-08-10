<?php
/**
 * CURL的多线程restful
 * Class CurlMulti
 */
class CurlMulti{
    /**
     * @param $urls 连接地址
     * @param string $method 获取方法
     * @param string $data 传输数据
     * @param array $option 扩展
     * @return array
     */
    public function curl($urls,$method='GET',$data='',$option=array()) {
        //允许并行地处理批处理cURL句柄
        $queue = curl_multi_init();
        $map = array();
        $opts = array(
            CURLOPT_TIMEOUT        => 30,//设置超时时间
            CURLOPT_RETURNTRANSFER => 1,//将获取的信息以文件流的形式返回,而不是直接输出
            CURLOPT_HEADER=>0,//是否获取头信息
            CURLOPT_NOSIGNAL=>true,
            CURLOPT_SSL_VERIFYPEER => 1,//https
            CURLOPT_SSL_VERIFYHOST => 2,//https
        );
        if($option){
            $opts = array_merge($opts,$option);
        }
        switch(strtoupper($method)){
            case 'POST':
                $opts[CURLOPT_POST] = 1;//post方式
                $opts[CURLOPT_POSTFIELDS] = $data;//post数据
                break;
            case 'PUT':
                $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';//put
                break;
            case 'DELETE':
                $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';//delete
                break;
        }
        if(is_string($data)){ //发送JSON数据
            $opts[CURLOPT_HTTPHEADER] = array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data),
            );
        }
        foreach ($urls as $key => $url) {
            //1:curl初始化
            $ch = curl_init();
            $opts[CURLOPT_URL] = $url;//设置url
            //2:设置变量
            curl_setopt_array($ch, $opts);
            curl_multi_add_handle($queue, $ch);
            $map[(string) $ch] = $url;
        }
        $responses = array();
        do {//3:执行curl并获取结果
            while (($code = curl_multi_exec($queue, $active)) == CURLM_CALL_MULTI_PERFORM) ;
            if ($code != CURLM_OK) { break; }
            while ($done = curl_multi_info_read($queue)) {
                $error = curl_error($done['handle']);
                $results = curl_multi_getcontent($done['handle']);
                $responses[$map[(string) $done['handle']]] = compact('error', 'results');
                curl_multi_remove_handle($queue, $done['handle']);
                curl_close($done['handle']);
            }
            if ($active > 0) {
                curl_multi_select($queue, 0.5);
            }
        } while ($active);
        //4:关闭curl
        curl_multi_close($queue);
        return $responses;
    }
}