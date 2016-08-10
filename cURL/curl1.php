<?php
    /**
     * curl的模拟登陆封装
     * @param  [string]  	$url        [所请求的URL地址]
     * @param  [string]  	$post       [请求类型]
     * @param  [array]  	$header     [表头数组]
     * @param  [string]  	$cookie     [请求的cookie字符串]
     * @param  [array]  	$data 		[请求的表单数据]
     * @param  [boolean] 	$retHeader  [是否返回header(比如需要获取header中的cookie)]
     * @return [type]              		[description]
     */
    function myCurl($url, $post, $header, $cookie, $data, $retHeader = false)
    {
        $ch = curl_init();
        if ($url != null)
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($header != null)
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                if ($cookie != null)
                    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, $retHeader);
                    if ($post == "post" || $post == "POST")
                        curl_setopt($ch, CURLOPT_POST, true);
                        if ($data != null) {
                            foreach ($data as $key => $value) {
                                $dstr[] = $key . '=' . $value;
                            }
                            $datafileds = implode('=', $dstr);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $datafileds);
                        }
                        $ret = curl_exec($ch);
                        curl_close($ch);
                        return $ret;
    }
    
    /**
     * 获取网页中的header
     *
     * @param [string] $content
     *            [网页内容（包含header）]
     * @return [string] [header的串]
     */
    function getHeader($content)
    {
        if ($content)
            list ($header, $body) = explode("\r\n\r\n", $content);
            else
                $header = null;
                return $header;
    }
    
    /**
     * 获取网页中的cookie
     *
     * @param [string] $content
     *            [网页内容（包含header）]
     * @return [array] [cookie数组]
     */
    function getCookie($content)
    {
        $cookie = null;
        $header = getHeader($content);
        preg_match_all("/set\-cookie:([^\n\r]*)/i", $header, $matches, PREG_SET_ORDER);
        foreach ($matches as $key) {
            $cookie[] = $key[1];
        }
        return $cookie;
    }
    
    $url = "https://www.zhihu.com/question/following";
    $cookie = '__utma=51854390.342890529.1460530311.1460530311.1460530311.1;__utmb=51854390.2.10.1460530311;__utmt=1;__utmv=51854390.000--|3=entry_date=20160413=1;__utmz=51854390.1460530311.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none);_xsrf=60b34b9bf403167f3c565ab313bdf24b;_za=59f006ac-4dca-491b-ac81-bcac14c56bcb;_zap=56da1fcc-abc2-4659-ad3f-0b0090fa46be;a_t="2.0AACDUBtknAcXAAAAaZHKVwAAg1AbZJwHAJAAEdCswwkXAAAAYQJVTaaOylcAh0gniYdDnDCDc9lTIaPQpFC5NGLUWdLfsRpGvet7XOpQUoIwzoR_8Q==";cap_id="MjQwYmE0ZTg2MDhlNDgxYTg2NDkyZjRjOGRlMGU0NTM=|1470300337|ef74bf0ed3453ee349d20b4cf05f804dcac3f4fb"; expires=Sat, 03 Sep 2016 08:44:22 GMT;d_c0="AJAAEdCswwmPTtULEc5gJc4OlRqJP5ZFeLQ=|1460530352";l_cap_id="YmQxYmE4NzEzZGUyNGU1Mzk1MDNkM2E0OTZlNmNhZTk=|1470300337|baeb768444c5f67a09d1432f56a1b9e244a8437b";l_n_c=1;n_c=1;q_c1=06f5e9e6c59e49f48217766489ca6e24|1470300337000|1460530354000;s-i=15;s-q=php;sid=cd0tq04o;z_c0=Mi4wQUFDRFVCdGtuQWNBa0FBUjBLekRDUmNBQUFCaEFsVk5wbzdLVndDSFNDZUpoME9jTUlOejJWTWhvOUNrVUxrMFln|1470300582|67d8bae143b15495060a9aea1b987f62bc5d7a8a;';
    $header = array(
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36 LBBROWSER',
        'Accept-Language: zh-CN,zh;q=0.8'
    );
    $ret = myCurl($url, "get", $header, $cookie, null, false);
    var_dump($ret);
    // echo $ret;die;
    preg_match_all("/<h2\sclass=\"zm-item-title\">\n\n<a.+href=\"(.*)\"\s>(.*)<\/a>\n*(<span\sclass=\"zg-num\">(.*)<\/span>)*\n*<\/h2>\n.*\n.*<a.*href=\"(.*)\"\starget=\"_blank\".*>(.*)<\/a>.*\n.*>(.*)<\/span>/i", $ret, $array);
    preg_match_all("/<a\shref=\"(\/people.*)\"/i", $ret, $mainPage);
    var_dump($mainPage);die;
    $mainPage = $mainPage[1][1];
    var_dump($array);die;
    $length = count($array[1]);
    for ($i = 0; $i < $length; $i ++) {
        $data["URL"][$i] = "http://www.zhihu.com" . $array[1][$i];
        $data["TITLE"][$i] = $array[2][$i];
        $data["NUM"][$i] = (int) $array[4][$i];
        $data["SMALLTITLE"][$i] = "由 " . $array[6][$i] . " 创建 • " . $array[7][$i];
    
        $data["CREATOR_URL"][$i] = $array[5][$i];
    }
    $url = 'http://www.zhihu.com' . $mainPage;
    // echo $url;die;
    $ret = myCurl($url, 'get', $header, $cookie, null, false);
    preg_match_all("/src=\"(.*)\"\sclass=\"zm-profile-header-img/", $ret, $icon);
    $data["ICON"] = $icon[1][0];
    $data = json_encode($data);
    print_r($data);