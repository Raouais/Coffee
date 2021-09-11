<?php

namespace App\Controller\Admin;

class InterfaceController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Interface');
    }
}