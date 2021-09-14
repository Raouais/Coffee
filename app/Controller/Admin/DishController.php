<?php

namespace App\Controller\Admin;

class DishController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Dish');
        $this->components[] = 'templates.navbar';
    }

    
    public function index(){
        $dishes = $this->Dish->all();   
        $this->render('admin.dish.index',compact('dishes'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Dish->create(
                [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.dish.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Dish->update(
                $_GET['id'], [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $dish = $this->Dish->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($dish);
        $this->render('admin.dish.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Dish->delete($_POST['id']);
            return $this->index();
        }
    }

    
}