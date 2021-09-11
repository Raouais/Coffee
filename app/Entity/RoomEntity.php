<?php

namespace App\Entity;

class RoomEntity extends \Core\Entity\Entity{

    public function getUrl(){
        return 'index.php?p=room.show&id='. $this->id;
    }
    

}