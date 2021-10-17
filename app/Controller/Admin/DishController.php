<?php

namespace App\Controller\Admin;

class DishController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Dish');
        $this->loadmodel('Menu');
        $this->loadmodel('DishesInMenu');
        $this->components[] = 'templates.navbar';
    }
    
    public function index(){
        $dishes = $this->Dish->all();   
        $selected = 0;
        if(!empty($_POST) && isset($_POST['menu'])){
            if($_POST['menu'] == 0){
                $dishes = $this->Dish->all();   
                $selected = 0;
            } else {
                $dishes = $this->Dish->getByMenu($_POST['menu']);
                $selected = $_POST['menu'];
            }
        }
        $title = "Plats";
        $form = new \Core\HTML\Bootstrap();
        $menus = $this->Menu->all();
        $this->render('admin.dish.index',compact('dishes','form','title','menus','selected'));
    }

    public function add(){
        $form = new \Core\HTML\Bootstrap($_POST);
        $title = "Ajout d'un plat";
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            if($_POST['name'] == "" || $_POST['price'] == ""){
                $error = "Tout les champs sont requis";
            } elseif($isImageUploaded){
                $this->Dish->create(
                    [
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'image' => $image,
                ]);
                return $this->index();
            }
        }
        $this->render('admin.dish.edit', compact('form','title','error'));
    }

    public function edit(){
        if(!empty($_GET)){
            $dish = $this->Dish->find($_GET['id'], 'id');
            $form = new \Core\HTML\Bootstrap($dish);
        }
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            $result = $this->Dish->update(
                $_GET['id'], [
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'image' => isset($dish) && !$isImageUploaded ? $dish->image : $image,
            ]);
            if($result)
                return $this->index();
        }
        $title = "Edition du plat ".$dish->name;
        $this->render('admin.dish.edit', compact('form','title','error'));
    }

    public function delete(){
        if(!empty($_GET)){
            $dish= $this->Dish->find($_GET['id'],'id');
            unlink(ROOT . 'public/uploads/'.$dish->image);
            $this->Dish->delete($_GET['id']);
            return $this->index();
        }
    }

    
}