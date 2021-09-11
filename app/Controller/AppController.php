<?php

namespace App\Controller;

use Core\Controller\Controller;

use \App;

class AppController extends Controller {


    protected $template = 'default';

    public function __construct(){
        $this->viewPath = ROOT . 'app/Views/';
    }

    public function loadmodel($model_name){
        $this->$model_name = App::getInstance()->getTable($model_name);
    }
    
}