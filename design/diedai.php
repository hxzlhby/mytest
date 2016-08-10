<?php
/**
 * Created by PhpStorm.
 * User: yil
 * Date: 2015/9/23
 * Time: 11:28
 */
class MyIterator implements Iterator {

    private $var = array();

    public function __construct($array) {
        $this->var = $array;
    }

    public function rewind() {
        reset($this->var);
    }

    public function current() {
        $var = current($this->var);
        return $var;
    }

    public function valid() {
        $var = $this->current() !== false;
        return $var;
    }

    public function next() {
        $var = next($this->var);
        return $var;
    }

    public function key() {
        $var = key($this->var);
        return $var;
    }
}
$values = array('a', 'b', 'c');
$it = new MyIterator($values);
var_dump($it);
foreach ($it as $a => $b) {
    print "$a: $b<br>";
}