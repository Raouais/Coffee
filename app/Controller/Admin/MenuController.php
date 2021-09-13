<?php

namespace App\Controller\Admin;

class MenuController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Menu');
        $this->template = 'admin';
    }

    public function index(){
        $menus = $this->Menu->all();   
        $this->render('admin.menu.index',compact('menus'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Menu->create(
                [
                'name' => $_POST['name'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.menu.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Menu->update(
                $_GET['id'], [
                'name' => $_POST['name'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $menu = $this->Menu->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($menu);
        $this->render('admin.menu.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Menu->delete($_POST['id']);
            return $this->index();
        }
    }
}