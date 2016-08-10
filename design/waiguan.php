<?php
//外观模式，通过在必须的逻辑和方法的集合前创建简单的外观接口，外观设计模式隐藏了来自调用对象的复杂性
class User{
    private $username;
    private $age;
    public function __construct(){}
    public function __set($proName,$value){
        switch($proName){
            case 'username':
                $this->username = $value;
                break;
            case 'age':
                $this->age = $value;
                break;
            default:
                echo '名称错误';
        }
    }
    public function getInfo(){
        echo '用户姓名:'.$this->username.'----用户年龄:'.$this->age;
    }
}
//创建一个User 类调用接口，简化获取用户getUser方法的调用
class UserFacade{
    public static function getUserInfo($userInfo){
        $user = new User();
        $user->username = $userInfo['username'];
        $user->age = $userInfo['age'];
        return $user->getInfo();
    }
}
$userInfo = array('username'=>'test1','age'=>18);
UserFacade::getUserInfo($userInfo);