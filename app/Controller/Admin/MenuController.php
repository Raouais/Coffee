<?php

namespace App\Controller\Admin;

class MenuController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Menu');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $form = new \Core\HTML\Bootstrap();
        $title = "Menu";
        $menus = $this->Menu->all();   
        $this->render('admin.menu.index',compact('menus','menus','title','form'));
    }

    public function add(){
        $form = new \Core\HTML\Bootstrap();
        $title = "Ajout d'un Menu";
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            if($_POST['name'] == ""){
                $error = "Tout les champs sont requis";
            } elseif($isImageUploaded){
                $this->Menu->create(
                    [
                    'name' => $_POST['name'],
                    'image' => $image,
                ]);
                return $this->index();
            }
        }
        $this->render('admin.menu.edit', compact('form','title','error'));
    }

    public function edit(){
        if(!empty($_GET)){
            $menu = $this->Menu->find($_GET['id'], 'id');
            $form = new \Core\HTML\Bootstrap($menu);
        }
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            $result = $this->Menu->update(
                $_GET['id'], [
                    'name' => $_POST['name'],
                    'image' => isset($menu) && !$isImageUploaded ? $menu->image : $image,
            ]);
            if($result)
                return $this->index();
        }
        $title = "Edition du Menu ".$menu->name;
        $this->render('admin.menu.edit', compact('form','title','error'));
    }

    public function delete(){
        if(!empty($_GET)){
            $menu = $this->Menu->find($_GET['id'],'id');
            unlink(ROOT . 'public/uploads/'.$menu->image);
            $this->Menu->delete($_GET['id']);
            return $this->index();
        }
    }
}