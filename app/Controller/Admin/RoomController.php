<?php

namespace App\Controller\Admin;


use \App;
use \Core\Auth\DBAuth;

class RoomController extends \App\Controller\AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Room');
        $this->loadmodel('Board');
        $this->loadmodel('Wall');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $items = $this->Room->all();
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.room.index', compact('form','items'));
    }

    public function add(){

        if(!empty($_POST)){
            $result = $this->Room->create(
                [
                'name' => $_POST['name'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.room.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Room->update(
                $_GET['id'], [
                'name' => $_POST['name']
            ]);
            if($result){
               return $this->index();
            }

        }
        $room = $this->Room->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($room);
        $this->render('admin.room.edit', compact('form'));

    }

    public function delete(){
        if(!empty($_GET)){
            $this->Room->delete($_GET['id']);
            $nbTables = sizeof($this->Board->findAll($_GET['id'],'room_id'));
            $nbWalls = sizeof($this->Wall->findAll($_GET['id'],'room_id'));

            for($i = 0; $i < $nbTables; $i++){
                $this->Board->deleteBy($_GET['id'],'room_id');
            }

            for($i = 0; $i < $nbWalls; $i++){
                $this->Wall->deleteBy($_GET['id'],'room_id');
            }

            return $this->index();
        }
    }

    public function show(){
        if(!empty($_GET['id'])){
            $item = $this->Room->find($_GET['id'],'id');
            $this->render('room.show', compact('item'));
        }
    }

}
