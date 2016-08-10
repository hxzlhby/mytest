<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/20
 * Time: 10:38
 */
class Moshu{
    public static $country = 'china';
    private $name;
    private $age = 18;
    private $mobile=110;
    const AREA = 'earth';
    public static $sex='boy';
    public $language='chinese';
    public $money=15000;
    public $city='beijing';
    public function __construct(){}
    /**
     * 设置私有成员属性的时候自动触发
     * @param $proName 成员属性名
     * @param $value 设置的值
     */
    public function __set($proName,$value){
        if($proName == 'name'){
            echo '魔术方法:__set';
            $this->name = $value;
        }else{
            echo '名称错误:__set';
        }
    }
    /**
     * 获取私有成员属性的时候自动触发
     * @param $proName 你访问的私有化成员属性名
     */
    public function __get($proName){
        echo '获取私有成员:__get';
        return $this->name;
    }
    /**
     * 在对私有成员isset判断的时候自动触发
     * @param $proName 成员属性名
     */
    public function __isset($proName){
        return isset($this->age);
    }
    /**
     * 在外部对私有成员属性进行unset操作的时候自动出发
     * @param $proName 成员属性名
     */
    public function __unset($proName){
        if($proName == 'mobile'){
            unset($this->mobile);
        }else{
            echo '该属性不能被删除';
        }
    }
    public function come(){
        return self::$country;//条用成语属性必须带$符号
    }
    public function say(){
        echo 'I come from '.self::come().self::AREA;
    }
    public static function eat(){
        echo self::say().self::$sex.'喜欢吃肉';//静态成员方法中不能使用$this
    }
    public function basic(){
        $this->eat();
    }
    /**
     * echo一个对象的时候返回字符串
     * 必须return一个字符串
     * @return string 字符串
     */
    public function __toString(){
        return 'echo对象的时候输出的字符串';
    }
    /**
     * 调用一个不存在的成员方法时自动触发
     * 防止调用时产生错误/简化操作(把多个方法集成在一个魔术方法之中)
     * 仅对调用一个不存在的成员方法有效，私有化成员没有效果
     * @param string $method 方法名
     * @param array $args 参数列表数组
     * @return number|string
     */
    public function __call($method,$args){
        switch($method){
            case 'from':
                return array_sum($args);
            case 'to':
                return json_encode($args);
            default:
                return '没有这个方法';
        }
    }
    /**
     * 对象串行化的时候自动触发
     * @return array 需要串行化的成员属性名 不能是私有化的成员属性
     */
    public function __sleep(){
        return array('language','money','city','name');
    }
    /**对象反串行化的时候自动触发 */
    public function __wakeup(){
        $this->mobile=112;
    }
    /*将对象当做函数调用时触发*/
    public function __invoke($x){
        var_dump($x);
    }
}
class Xifa extends Moshu{
    public function say(){
        echo '我来自'.parent::come().Moshu::AREA;
    }
    /**
     * 在clone对象的时候自动触发
     * 没有返回值，一般仅用于clone对象的时候修改成员属性
     * $new Obj= clone $oldObj
     */
    public  function __clone(){
        $this->language = '汉语';
    }
}
echo '<pre>';
$a = new Moshu();
$a->name = '设置私有成员属性';
$name = $a->name;
var_dump($name);
unset($a->mobile);
var_dump(isset($a->age));
$a->say();
$xf = new Xifa();
$xf->say();
Moshu::eat();
$xf->basic();
echo $xf;
//var_dump($xf);
$lq = clone $xf;
//var_dump($lq);
var_dump($lq->to(1,2,3,4,5,6));
$a->money = 16000;
$str = serialize($a);
var_dump($str);
$str2 = unserialize($str);
//var_dump($str2);
$a(5);//函数式调用对象,触发__invoke