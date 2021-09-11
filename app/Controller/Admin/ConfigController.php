<?php

namespace App\Controller\Admin;

use App;

class ConfigController extends AppController{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $from = new \Core\HTML\Bootstrap($_POST);
        $this->template = 'default';
        $this->render('admin.config.index', compact('form'));
    }

    public function logout(){
        session_start();
        unset($_SESSION['auth_id']);
        unset($_SESSION['auth_api']);
        unset($_SESSION['auth_role']);
        session_destroy();
        header('Location: index.php');
    }
}