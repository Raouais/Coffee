<?php

namespace App\Entity;

class ProductEntity extends \Core\Entity\Entity{

    public function getUrl(){
        return 'index.php?p=product.show&id='. $this->id;
    }
    

}