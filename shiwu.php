<?php
/**
 * Class db
 * 单例模式的数据库类
 */
class db {
    private static $dsn = 'mysql:host=localhost;dbname=beifen';
    public static $instance=null;
    private function __construct(){}
    private static function conn(){
        $pdo = new PDO(self::$dsn,'root','root');
        $pdo->exec('set names utf8');
        return $pdo;
    }
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = self::conn();
        }
        return self::$instance;
    }
}
$pdo = db::getInstance();
//准备事物相关处理,数据库必须是innodb
//1:关闭自动提交(前提)
$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
//2:开启事物机制
$pdo->beginTransaction();
//3:进行事物操作
$res1 = $pdo->exec("UPDATE brand SET modify_admin_id=modify_admin_id-10 WHERE id=1");
$res2 = $pdo->exec("UPDATE brand SET modify_admin_id=modify_admin_id+10 WHERE id=30");
//4:判断操作,决定是提交还是回滚
if($res1 && $res2){
    $pdo->commit();//操作成功,提交事物
}else{
    $pdo->rollBack();//操作失败,回滚事物
}
//5:开启自动提交
$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,true);