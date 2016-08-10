<?php

/**
 * Class db
 * 单例模式的数据库类
 */
class db {
    private static $dsn = 'mysql:host=localhost;dbname=onethink';
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
$db = db::getInstance();
//var_dump($db);
//$sql = "SELECT id,name,type FROM onethink_wx_menu WHERE type=:type";
//$stmt = $db->prepare($sql);
//$type = 'click';
//$stmt->bindValue(':type',$type);
//$stmt->execute();
//$sql = "SELECT clid,name FROM classroom ORDER BY uid LIMIT 3";
//$sql = "INSERT INTO classroom(uid,name) VALUES(?,?)";
//$stmt = $db->prepare($sql);
//$data = array(446,'ceshi003');
//$stmt->bindParam(1,$uid);
//$stmt->bindParam(2,$name);
//$sql = "INSERT INTO classroom(uid,name) VALUES(:uid,:name)";
//$stmt = $db->prepare($sql);
//$stmt->bindParam(':uid',$uid);
//$stmt->bindParam(':name',$name);
//$uid = 445;
//$name = 'ceshi01';
//$data = array(':uid'=>446,':name'=>'ceshi003');
//$stmt->execute($data);
//$stmt->bindColumn(1,$clid);
//$stmt->bindColumn(2,$name);
$sql = "UPDATE onethink_wx_menu SET pid=:pid WHERE id=:id";
$stmt = $db->prepare($sql);
$id = 18;
$pid = 11;
$stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();//更新id=18
$id = 19;
$pid = 22;
$stmt->execute();//更新id=19
unset($pid, $id);
$id = 16;
$pid = 33;
$stmt->bindValue(':pid',$pid,PDO::PARAM_INT);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$stmt->execute();//更新id=16
$id = 17;
$pid = 44;
//$stmt->bindValue(':pid',$pid,PDO::PARAM_INT);
//$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$stmt->execute();//更新id=16,再次绑定才能重新赋值

echo '<pre>';
var_dump($stmt->rowCount());
//$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($row);
//while($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
//    echo $clid.'------'.$name;
//    var_dump($row2);
//}
//var_dump($stmt->rowCount());
//$uid = 445;
//$name = 'ceshi02';
//$stmt->execute();
//var_dump($stmt->rowCount());