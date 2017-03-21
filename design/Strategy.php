<?php
/**
* 策略模式
* 策略模式设计帮助构建的对象不必自身包含逻辑，而是能够根据需要利用其他对象中的算法。
* 
* 使用场景：
* 1. 例如有一个CD类，我们类存储了CD的信息。
* 2. 原先的时候，我们在CD类中直接调用getCD方法给出XML的结果
* 3. 随着业务扩展，需求方提出需要JSON数据格式输出
* 4. 这个时候我们引进了策略模式，可以让使用方根据需求自由选择是输出XML还是JSON
*/
interface OutputInterface
{
    public function load($data);
}

class OutputJson implements OutputInterface
{
    public function load($data)
    {
        return json_encode($data);
    }
}

class OutputSerialize implements OutputInterface 
{
    public function load($data) 
    {
        return serialize($data);
    }
}

class OutputArray implements OutputInterface
{
    public function load($data) 
    {
        return (array)$data;
    }
}

class Strategy
{
    private $_interface;
    public function load($data) 
    {
        return $this->_interface->load($data);
    }
    public function setOutput(OutputInterface $obj) 
    {
        $this->_interface = $obj;
    }
}

$c = new Strategy();
$c->setOutput(new OutputJson());
$c->setOutput(new OutputArray());
$data = $c->load([1,2,3]);
var_dump($data);
