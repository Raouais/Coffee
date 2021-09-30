<?php

namespace App\Controller\Admin;

class RoleController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Role');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $roles = $this->Role->all();   
        $this->render('admin.role.index',compact('roles'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Role->create(
                [
                'name' => $_POST['name'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.role.edit', compact('form'));

    }

    public function edit(){
        if(!empty($_POST)){
            $result = $this->Role->update(
                $_GET['id'], [
                'name' => $_POST['name'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $role = $this->Role->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($role);
        $this->render('admin.role.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Role->delete($_POST['id']);
            return $this->index();
        }
    }
}