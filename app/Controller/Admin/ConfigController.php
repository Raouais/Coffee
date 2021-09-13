<?php

namespace App\Controller\Admin;

use App;

class ConfigController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->template = 'admin';
    }

    public function index(){
        $from = new \Core\HTML\Bootstrap($_POST);
        $pages = array(
            "Produits"     => "?p=admin.produit.index",
            "Salles"       => "?p=admin.room.index",
            "Commandes"    => "?p=admin.command.index",
            "Utilisateurs" => "?p=admin.user.index",
            "Interfaces"   => "?p=admin.interface.index",
            "Menu"         => "?p=admin.menu.index",
        );
        $this->render('admin.config.index', compact('form','pages'));
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