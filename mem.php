<?php
$mem = new Memcache();
$mem->connect('127.0.0.1',11211);
echo '<pre>';
var_dump($mem->set('key','hello world',0,360));
var_dump($mem->set('start','hello memcache',0,360));
var_dump($mem->get('key'));
//$mem->delete('key');
var_dump($mem->replace('key','hello php',0,360));
var_dump($mem->get('key'));
var_dump($mem->getstats());
$mem->close();