<?php

namespace App\Controller\Admin;

class UserController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('User');
        $this->loadmodel('Role');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $title = "Utilisateurs";
        $role = $this->Role;
        $users = $this->User->all(); 
        $form = new \Core\HTML\Bootstrap(); 
        $this->render('admin.user.index',compact('users','role','title','form'));
    }

    public function add(){
        if(!empty($_POST)){

            if($this->isUserExist($_POST['name'])){
                $error = "L'utilisateur ".$_POST['name']." existe dèjà !";
            } else if($_POST['password'] === $_POST['password_confirm'] && $_POST['password'] !== ""){
                $result = $this->User->create(
                    [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
                    'role_id' => $_POST['role_id'],
                ]);
                return $this->index();
            } else {
                $error = 'Mots de passe différents ou vides';
            }
        }
        $role = $this->Role->all();
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.user.edit', compact('form','role','error'));
    }

    public function edit(){

        if(!empty($_GET)){
            $user = $this->User->find($_GET['id'],'id');
            $form = new \Core\HTML\Bootstrap($user);
        } else {
            header('Location: index.php');
        }

        if(!empty($_POST)){
            if($this->isUserExist($_POST['name'])){
                $error = "L'utilisateur ".$_POST['name']." existe dèjà !";
            } else if($_POST['password'] === $_POST['password_confirm'] && $_POST['password'] !== ""){
                $result = $this->User->update(
                    $_GET['id'], [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
                    'role_id' => $_POST['role_id'],
                ]);
            } else if($_POST['password'] === $_POST['password_confirm'] && $_POST['password'] === ""){
                $result = $this->User->update(
                    $_GET['id'], [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'role_id' => $_POST['role_id'],
                ]);
            } else {
                $error  = 'Mots de passe différents ou vides';
            }

            if(isset($result)){
               return $this->index();
            }

        }
        $role = $this->Role->all();
        $this->render('admin.user.edit', compact('form','role','user','error'));
    }

    public function delete(){
        if(!empty($_GET)){
            $this->User->delete($_GET['id']);
            return $this->index();
        }
    }

    private function isUserExist($name): bool{
        if($this->User->find($_POST['name'],'name'))
            return true;
        return false;
    }
}