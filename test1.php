<?php
$news = array(array(1,2,3,4),array('a','b','c','d'));
$news2= array('a','b','c','d');
$articles = array();
foreach ($news as $key => $value) {
    list(
        $articles[$key]['Title'],
        $articles[$key]['Description'],
        $articles[$key]['Url'],
        $articles[$key]['PicUrl']
    ) = $value;
    if ($key >= 9) {
        break;
    }
}
echo '<pre>';
var_dump($articles);