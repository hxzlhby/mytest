<?php
$re = new Redis();
$re->connect('127.0.0.1');
var_dump($re->set('key','hello world'));
var_dump($re->set('start','Hello Redis'));
var_dump($re->get('key'));
$re->close();