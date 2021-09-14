<?php

namespace App\Controller\Admin;

class InterfaceController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Interface');
        $this->components[] = 'templates.navbar';
    }


    
    public function index(){
        $interfaces = $this->Interface->all();   
        $this->render('admin.interface.index',compact('interfaces'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Interface->create(
                [
                'name' => $_POST['name'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.interface.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Interface->update(
                $_GET['id'], [
                'name' => $_POST['name'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $interface = $this->Interface->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($interface);
        $this->render('admin.interface.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Interface->delete($_POST['id']);
            return $this->index();
        }
    }

    
}