<?php

namespace App\Controller\Admin;

class UserController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('User');
        $this->template = 'admin';
    }

    public function index(){
        $users = $this->User->all();   
        $this->render('admin.user.index',compact('users'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->User->create(
                [
                'name' => $_POST['name'],
                'lastname' => $_POST['lastname'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.user.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->User->update(
                $_GET['id'], [
                'name' => $_POST['name'],
                'lastname' => $_POST['lastname'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $user = $this->User->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($user);
        $this->render('admin.user.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->User->delete($_POST['id']);
            return $this->index();
        }
    }
}