<?php
//解释器模式 用于分析一个实体的关键元素，并且针对每个元素提供自己的解释或相应动作
//解释器模式非常常用，比如PHP的模板引擎 就是非常常见的一种解释器模式
class template {

    private $left  = '<!--{';
    private $right = '}-->';

    public function run($str) {
        return $this->init($str, $this->left, $this->right);
    }

    /**
     * 模板驱动-默认的驱动
     * @param  string $str 模板文件数据
     * @return string
     */
    private function init($str, $left, $right) {
        $pattern = array('/'.$left.'/', '/'.$right.'/');
        $replacement = array('', '');
        return preg_replace($pattern, $replacement, $str);
    }
}
$str = "这是一个模板类，简单的模板类，标题为：<!--{Hello World}-->";
$template = new template;
echo $template->run($str);
//这是一个模板类，简单的模板类，标题为：Hello World