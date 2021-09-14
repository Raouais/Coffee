<?php

namespace App\Controller\Admin;

class UserController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('User');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $users = $this->User->all();   
        $this->render('admin.user.index',compact('users'));
    }

    public function add(){
        if(!empty($_POST)){
            if($_POST['password'] === $_POST['password_confirm']){
                $result = $this->User->create(
                    [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
                    'role_id' => $_POST['role_id'],
                ]);
                return $this->index();
            } else {
                echo 'Mots de passe différentes';
            }
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.user.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            if($_POST['password'] === $_POST['password_confirm']){
                $result = $this->User->update(
                    $_GET['id'], [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
                    'role_id' => $_POST['role_id'],
                ]);
            } else {
                echo 'Mots de passe différentes';
            }

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
            $this->User->delete($_POST['id']);
            return $this->index();
        }
    }
}