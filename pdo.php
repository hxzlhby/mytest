<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/21
 * Time: 23:29
 */
try{
    $dsn = 'mysql:host=localhost;dbname=ceshi';
    $pdo = new PDO($dsn,'root','root');
    $pdo->exec('set names utf8');
    $sql = "SELECT clid,name FROM classroom ORDER BY uid LIMIT 3";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo '<pre>';
    $row = $stmt->fetchAll(PDO::FETCH_COLUMN);
    var_dump($row);
//    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
//        var_dump($row);
//    }
//    $result = $pdo->query($sql);
//    echo '<pre>';
//    var_dump($result);
//    foreach($result as $k=>$v){
//        var_dump($v);
//    }
}catch (PDOException $e){
    echo $e->getMessage();
}
