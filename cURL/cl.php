<?php

class Cl
{

    public $domain, $limit_page;

    function __construct()
    {
        // 替换为真实的地址 它老是变 你懂的
        $this->domain = 'http://cl.lxrfg.com/';
        $this->limit_page = 10;
    }

    public function getList()
    {
        for ($i = 1; $i <= $this->limit_page; $i ++) {
            // 无码区
            $list_url = $this->domain . 'thread0806.php?fid=2&search=&page=$page';
            $list_url = str_replace('$page', $i, $list_url);

            $content = $this->__curl($list_url);

            $content = iconv('gbk', 'utf-8', $content);
            preg_match_all('/<h3><a href="(htm_data\/2.*?)" target="_blank" id="">(.*?)<\/a><\/h3>/msi', $content, $matches);
            if ($matches && $matches[1]) {
                foreach ($matches[1] as $key => $url) {
                    $detail_url = $this->domain . $url;
                    $title = $matches[2][$key];

                    if (strpos($title, '發帖注意事項') !== false || strpos($title, '影片教程') !== false) {
                        continue;
                    }
                    // file_put_contents('/tmp/cl.log', $i . '-' . $key . '-' . $title . $detail_url . "\n", FILE_APPEND);
                    $res[] = $this->getDetail($detail_url, $title);
                }
                return $res;
            }
        }
    }

    public function getDetail($url, $title)
    {

        // $url = $this->domain . 'htm_data/2/1607/2013852.html';
        // $title = '07/30最新pacopacomama 073016_134 色氣奧樣';
        $content = $this->__curl($url);
        $content = iconv('gbk', 'utf-8', $content);
        if (strpos($content, 'rmdown') === false) {
            return;
        }

        $content = str_replace('______', '.', $content);
        preg_match_all('/http:\/\/www\.rmdown\.com\/link\.php\?hash=\w+/', $content, $matches);
        if ($matches && $matches[0]) {
            $urls = array_unique($matches[0]);
            foreach ($urls as $key => $value) {
                if (! $key) {
                    $key = '';
                }
                $this->downloadTorrent($value, $title . $key);
            }
        }
    }

    public function downloadTorrent($url, $title)
    {
        $title = str_replace(array(
            "\n",
            ' ',
            '/',
            ':',
            '*',
            '?',
            '"',
            '<',
            '>',
            '|'
        ), '', $title);
        // file_put_contents('/tmp/cl.log', "有种子{$title}\n", FILE_APPEND);
        $content = $this->__curl($url);
        preg_match('/<INPUT size=58 name="ref" value="(.*?)"/', $content, $matches1);
        preg_match('/<INPUT TYPE="hidden" NAME="reff" value="(.*?)"/', $content, $matches2);
        $url = 'http://www.rmdown.com/download.php?ref=' . $matches1[1] . '&reff=' . $matches2[1];

        file_put_contents('./torrent/' . iconv('utf-8', 'gbk', $title) . '.torrent', $this->__curl($url));
    }

    private function __curl($url, $params = array())
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        if ($params) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

            $headers = array();
            $headers['Content-type'] = 'multipart/form-data';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36 QQBrowser/4.0.4035.400');
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

$cl = new Cl();
$data= $cl->getList();
// var_dump($data);