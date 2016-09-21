<?php  
    class ExtentionFinder extends FilterIterator  
    {  
        public $predicate, $path;  
        public function __construct($path, $predicate)  
        {  
            $this->predicate = $predicate;  
            $this->path = $path;  
  
            $it = new RecursiveDirectoryIterator($path);  
            $flatIterator = new RecursiveIteratorIterator($it);  
  
            parent::__construct($flatIterator);  
        }  
  
        public function accept()  
        {  
            $pathInfo = pathinfo($this->current());  
            $extension = $pathInfo['extension'];  
  
            return ($extension == $this->predicate);  
        }  
    }  
 
  
    $it = new ExtentionFinder('./', 'php');  
    foreach($it as $value)
    {
        echo $value."<br/>";  
    }
    
    function listDir($dir)
    {
        if(is_dir($dir))
        {
            if($handle = opendir($dir))
            {
                while($file = readdir($handle))
                {
                    if($file != '.' && $file != '..')
                    {
                        if(is_dir($dir.DIRECTORY_SEPARATOR.$file))
                        {
                            echo '目录名：'.$dir.DIRECTORY_SEPARATOR.''.$file.'<br>';
                            listDir($dir.DIRECTORY_SEPARATOR.$file);
                        }else{
                            echo '文件名：'.$dir.DIRECTORY_SEPARATOR.$file.'<br>';
                        }
                    }
                }
            }
            closedir($handle);
        }else{
            echo '非有效目录!';
        }
    }
//     listDir('./');
    function tree($dir)
    {
        $res = array();
        $mydir = dir($dir);
        while($file = $mydir->read())
        {
            if($file != '.' && $file != '..')
            {
                if(is_dir("$dir/$file"))
                {
                    $res['dir'][] = $file;
//                     echo '目录名：'.$dir.DIRECTORY_SEPARATOR.''.$file.'<br>';
//                     tree("$dir/$file");
                }else{
                    $res['file'][] = $file;
//                     echo '文件名：'.$dir.DIRECTORY_SEPARATOR.$file.'<br>';
                }
            }
        }
        $mydir->close();
        return $res;
    }
    echo '<pre>';
    var_dump(tree('./class'));
    
    function recurDir($pathName) {
        $result = array();
        $tmp = array();
        if( !is_dir($pathName) || !is_readable($pathName) ){
            return null;
        }
        $allFiles = scandir($pathName);
        foreach($allFiles as $fileName){
            if( in_array($fileName, array('.', '..')) ) continue;
            $fullName = $pathName . '/' . $fileName;
            if( is_dir($fullName) ){
                $result[$fileName] = recurDir($fullName);
            }else{
                $temp[] = $fileName;
            }
        }
        if($temp){
            foreach( $temp as $f ){
                $result[] = $f;
            }
        }
    
        return $result;
    }
//     $tree = recurDir('./');
//     echo "<pre>";
//     print_r($tree);
//     echo "</pre>";