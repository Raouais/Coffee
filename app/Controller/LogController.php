<?php

namespace App\Controller;

use App\Controller\AppController;
use \App;

class LogController extends AppController{

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        
        
        $auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());
        $form = new \Core\HTML\Bootstrap();

        $title = "Authentification";

        if(isset($_SESSION['auth_id'])){
            if($_SESSION['auth_role'] === 1){
                header('Location: index.php?p=admin.config.index');
            } else {
                header('Location: index.php?p=user.profile');
            }
            exit();
        }

        if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
            if($_POST['username'] == "" && $_POST['password'] == ""){
                $error = "Tout les champs sont requis";
                exit();
            } else {
                $user = $auth->login($_POST['username'], $_POST['password']);
                if(!isset($user)){
                    $error = "Les identifiants sont incorrectes";
                } elseif($user->role_id === "2") {
                    $_SESSION['auth_role'] = 2;
                    header('Location: index.php?p=user.profile');
                    exit();
                } elseif($user->role_id == "1") {
                    $_SESSION['auth_role'] = 1;
                    header('Location: index.php?p=admin.config.index');
                    exit();
                }
            }
        } 

        $this->render('log.index', compact('form','title','error'));
    }
}