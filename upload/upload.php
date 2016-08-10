<?php
include_once('../class/Upload.class.php');
echo '<pre>';
$api = new Upload();
$res = $api->upload($_FILES);
$error = $api->getError();
var_dump($error);
var_dump($res);