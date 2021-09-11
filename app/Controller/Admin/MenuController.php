<?php

namespace App\Controller\Admin;

class MenuController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Menu');
    }
}