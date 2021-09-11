<?php

namespace App\Controller\Admin;

class CategoryController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Category');
    }
}