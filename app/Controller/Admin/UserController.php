<?php

namespace App\Controller\Admin;

class UserController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('User');
    }
}