<?php
class file{

    public static function readDir($path){
        if(!is_dir($path))
            return false;
//        $path=iconv("utf-8","gb2312",$path);
        $handle = opendir($path);
        $file = array();
//        global $file;
        while(($item = readdir($handle)) !=false){
            if($item !='.' && $item != '..'){
//                $item = iconv('gb2312','utf-8',$item);
                if(is_file($path.'/'.$item)){
                    $file['file'][] = iconv('gb2312','utf-8',$item);
                }else if(is_dir($path.'/'.$item)){
                    $file['dir'][] = $item;
//                    self::readDir($path.'/'.$item);
                }
            }
        }
        closedir($handle);
        return $file;
    }

    function my_scandir($dir){
        $files=array();
        if(is_dir($dir)){
            if($handle=opendir($dir)){
                while(($file=readdir($handle))!==false){
                    if($file!="." && $file!=".."){
                        if(is_dir($dir."/".$file)){
                            $files[$file]=my_scandir($dir."/".$file);
                        }else{
                            $files[]=$dir."/".$file;
                        }
                    }
                }
                closedir($handle);
                return $files;
            }
        }
    }

}
echo '<pre>';
$path = 'D:\test\function';
$res = file::readDir($path);
var_dump($res);
foreach($res['file'] as $k =>$v){
    $val[$v] = md5_file($path.'/'.iconv('utf-8','gb2312',$v));
}
var_dump($val);