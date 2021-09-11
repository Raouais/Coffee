<?php

namespace App\Controller;

use App\Controller\AppController;
use \App;

class RoomController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Room');
    }
    
    public function index(){
        $from = new \Core\HTML\Bootstrap($_POST);
        $items = $this->Room->all();
        $this->render('room.index', compact('form','items'));
    }

    public function show(){
        if(!empty($_GET['id'])){
            $items = $this->Room->find($_GET['id'],'id');
            $this->render('room.show', compact('items'));
        }
    }

}

    