<?php
//memcached
$md = new Memcached();
$md->addServer('127.0.0.1',11211);
$md->set('foo','hello world',120);
var_dump($md->get('foo'));