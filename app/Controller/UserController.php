<?php

namespace App\Controller;

use App\Controller\AppController;
use \App;

class UserController extends AppController{

    public function __construct(){
        parent::__construct();
    }

    public function profile(){
        $form = new \Core\HTML\Bootstrap();
        $this->render('user.profile',compact('form'));
    }

    public function logout(){
        session_start();
        // setcookie('remember', NULL -1);
        unset($_SESSION['auth_id']);
        unset($_SESSION['auth_role']);
        session_destroy();
        header('Location: index.php');
    }
}

    