<?php
class Db{
    private static $dsn = 'mysql:host=localhost;dbname=ceshi';
    private static $user = 'root';
    private static $pwd = 'root';
    public static $instance = null;
    public $sql;
    public static $pdo;
    private function __construct(){
        self::$pdo = new PDO(self::$dsn,self::$user,self::$pwd);//1连接数据库
        self::$pdo->exec('set names utf8');//2设置字符集
    }
/*    private static function conn(){
        self::$pdo = new PDO(self::$dsn,self::$user,self::$pwd);//1连接数据库
        self::$pdo->exec('set names utf8');//2设置字符集
        return self::$pdo;
    }*/
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * 插入数据
     * @param $table
     * @param $data
     * @return int
     */
    public function insert($table,$data){
        $values = '';
        $keys = '';
        foreach($data as $k=>$v){
            $values .= $k.',';
            $keys .= ':'.$k.',';
        }
        $values = rtrim($values,',');
        $keys = rtrim($keys,',');
        $this->sql = "INSERT INTO {$table} ({$values}) VALUES ({$keys})";
        $stmt = self::$pdo->prepare($this->sql);
        foreach($data as $k=>$v){
            $stmt->bindValue(':'.$k,$v);
        }
        $stmt->execute();
        return $stmt->rowcount();
    }
    /**
     * 查询
     * @param $table
     * @param array $map
     * @param array $field
     * @param string $order
     * @param string $limit
     * @return array
     */
    public function select($table,$map=array(),$field=array(),$order='',$limit=''){
        $where = '';
        if(!empty($map)){
            foreach($map as $k=>$v){
                $where .= is_array($v)?($k.' '.$v[0]." '".$v[1]."' and "): $k."='".$v."' and ";
            }
            $where=substr('WHERE '.$where,0,-4);
        }
        $fieldstr = '';
        if(!empty($field)){
            foreach($field as $k=>$v){
                $fieldstr.= $v.',';
            }
            $fieldstr = rtrim($fieldstr,',');
        }else{
            $fieldstr = '*';
        }
        $orderstr = '';
        if(!empty($order)){
            $orderstr .= 'ORDER BY '.$order;
        }
        $limitstr = '';
        if(!empty($order)){
            $limitstr .= 'LIMIT '.$limit;
        }
        $this->sql = "SELECT {$fieldstr} FROM {$table} {$where} {$orderstr} {$limitstr}";
        var_dump($this->sql);
        $stmt = self::$pdo->prepare($this->sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($table,$map=array(),$data=array()){

    }

}
