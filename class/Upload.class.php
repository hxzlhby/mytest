<?php
class Upload{
    protected $path;
    protected $allowExts;
    protected $allowMaxSize;
    protected $allowMime;
    protected $fileInfo;
    protected $savename;
    private $error = ''; //上传错误信息

    public function __construct($path='./Uploads/',$allowExts=array('jpg','jpeg','png','bmp'),$allowMaxSize=2097152,$allowMime=array(),$savename=false){
        $this->path = $path;//上传路径
        $this->allowExts = $allowExts;//允许后缀名
        $this->allowMaxSize = $allowMaxSize;//允许上传大小
        $this->allowMime = $allowMime;//是否检查图片
        $this->savename = $savename;//保存文件名
    }
    public function getError(){
        return $this->error;
    }
    /**
     * 检查根目录
     */
    protected function checkRootPath($path){
        if(!(is_dir($path) && is_writable($path))){
            $this->error = '没有根目录,请手动创建';
            return false;
        }
        $this->path = $path;
        return true;
    }
    private function dealFiles($files) {
        $fileArray = array();
        $n = 0;
        foreach($files as $key=>$file){
            if(is_array($file['name'])){
                $keys = array_keys($file);
                $count = count($file['name']);
                for($i=0;$i<$count;$i++){
                    $fileArray[$n]['key'] = $key;
                    foreach($keys as $_key){
                        $fileArray[$n][$_key] = $file[$_key][$i];
                    }
                    $n++;
                }
            }else{
                $fileArray = $files;
                break;
            }
        }
        return $fileArray;
    }
    public function upload($files=''){
        if(''===$files){
            $files = $_FILES;
        }
        if(empty($files)){
            $this->error = '没有上传的文件';
            return false;
        }
        if(!$this->checkRootPath($this->path)){
            return false;
        }
        /* 逐个检测并上传文件 */
        $info    =  array();
        if(function_exists('finfo_open')){
            $finfo   =  finfo_open ( FILEINFO_MIME_TYPE );
        }
        $files = $this->dealFiles($files);//格式化文件信息
        foreach($files as $key=>$file){
            $file['name'] = strip_tags($file['name']);
            if(!isset($file['key']))    $file['key'] = $key;
            if(isset($finfo)){
                $file['type'] = finfo_file($finfo,$file['tmp_name']);
            }
            $file['ext'] = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            if(!$this->check($file)){
                continue;
            }
            $savename = $this->getSaveName($file);
            if(false == $savename){
                continue;
            } else {
                $file['savename'] = $savename;
            }
            //对图像文件进行严格检查
            if(in_array($file['ext'],array('jpg','jpeg','png','gif','bmp','swf'))){
                $imginfo = getimagesize($file['tmp_name']);
                if(empty($imginfo) || ($file['ext'] == 'gif' && empty($imginfo['bits']))){
                    $this->error = '非法图像文件';
                    continue;
                }
            }
            if($this->save($file)){
                unset($file['error'],$file['tmp_name']);
                $info[$key] = $file;
            }
        }
        if(isset($finfo)){
            finfo_close($finfo);
        }
        return empty($info) ? false : $info;
    }
    public function save($file){
        $savePath = $this->path.$file['savename'];
        if(is_file($file['savename'])){
            $this->error = '存在同名文件';
            return false;
        }
        if(!move_uploaded_file($file['tmp_name'],$savePath)){
            $this->error = '移动文件出错';
            return false;
        }
        return true;
    }

    /**
     * 获取文件的保存名称
     * @param $file
     * @return string
     */
    private function getSaveName($file){
        if($this->savename){
            /* 解决pathinfo中文文件名BUG */
            $savename = substr(pathinfo("_{$file['name']}", PATHINFO_FILENAME), 1);
        }else{
            $savename = md5(uniqid(microtime(true),true));
        }
        return $savename.'.'.$file['ext'];
    }
    private function check($file){
        //检查上传error号
        if($file['error']){
            $this->error($file['error']);
            return false;
        }
        //检查文件名
        if(empty($file['name'])){
            $this->error = '未知上传错误';
            return false;
        }
        //检查是否post上传
        if(!is_uploaded_file($file['tmp_name'])){
            $this->error = '非法上传文件';
        }
        //检查上传大小
        if(!$this->checkSize($file['size'])){
            $this->error = '上传文件大小不符';
            return false;
        }
        //检查文件后缀
        if(!$this->checkExt($file['ext'])){
            var_dump($file['ext']);
            $this->error = '文件后缀不允许';
            return false;
        }
        //检查mime类型
        if(!$this->checkMime($file['type'])){
            $this->error = '文件mime类型不符合';
            return false;
        }
        //通过检查
        return true;
    }

    /**
     * 检查大小是否合法
     * @param $size
     */
    private function checkSize($size){
        return !($size>$this->allowMaxSize || 0==$this->allowMaxSize);
    }
    /**
     * 检查后缀名是否合法
     * @param $ext
     */
    private function checkExt($ext){
        return empty($this->allowExts) ? true : in_array($ext,$this->allowExts);
    }
    /**
     * 检查上传的文件MIME类型是否合法
     * @param string $mime 数据
     */
    private function checkMime($mime) {
        return empty($this->allowMime) ? true : in_array(strtolower($mime), $this->allowMime);
    }
    private function error($errorNo){
        switch ($errorNo) {
            case 1:
                $this->error = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值！';
                break;
            case 2:
                $this->error = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值！';
                break;
            case 3:
                $this->error = '文件只有部分被上传！';
                break;
            case 4:
                $this->error = '没有文件被上传！';
                break;
            case 6:
                $this->error = '找不到临时文件夹！';
                break;
            case 7:
                $this->error = '文件写入失败！';
                break;
            default:
                $this->error = '未知上传错误！';
        }
    }
}