<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/22
 * Time: 15:27
 */
class DataBase {
    public static $cennct = null;
    private function __construct(){return false;}
    private function conn(){
        $pdo = new PDO('mysql:host=localhost;dbname=ceshi','root','root');
        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $pdo->query('set names utf8');
        return $pdo;
    }
    public static function getdb(){
        if(self::$cennct == null )
            self::$cennct = self::conn();
        return true;
    }
    protected function fetch($sql,$param=array()){
        $this->getdb();
        $tmp = self::$cennct->prepare($sql);
        $tmp->execute($param);
        return $tmp->fetch(PDO::FETCH_ASSOC);
    }
    protected function fetchAll($sql,$param=array()){
        $this->getdb();
        $tmp = self::$cennct->prepare($sql);
        $tmp->execute($param);
        return $tmp->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function execute($sql,$param=array()){
        $this->getdb();
        $tmp = self::$cennct->prepare($sql);
        return $tmp->execute($param);
    }
}