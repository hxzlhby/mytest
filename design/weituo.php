<?php
class CD{
    protected $cd = array();
    public function addSong($song){
        $this->cd[$song] = $song;
    }
    public function play($type,$song){
        $type = new $type;
        return $type->playList($this->cd,$song);
    }
}
class Mp3{
    public function playList($list,$song){
        return $list[$song];
    }
}
$newCd = new CD();
$newCd->addSong(1);
$newCd->addSong(2);
$newCd->addSong(3);
$res = $newCd->play('Mp3',1);
var_dump($res);