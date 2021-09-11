<?php

namespace Core\Entity;

use Core\Table\Table;

class Entity{

    public function __get($key){
        $method = 'get'.ucfirst($key);  //ucfirst met la premiere lettre en majuscule
        $this->$key = $this->$method();
        return $this->$key;
    }

}