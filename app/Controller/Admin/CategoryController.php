<?php

namespace App\Controller\Admin;

class CategoryController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Category');
        $this->template = 'admin';
    }

    
    public function index(){
        $categories = $this->Category->all();   
        $this->render('admin.category.index',compact('categories'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Category->create(
                [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'category_id' => $_POST['category_id'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.category.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Category->update(
                $_GET['id'], [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'category_id' => $_POST['category_id'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $category = $this->Category->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($category);
        $this->render('admin.category.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Category->delete($_POST['id']);
            return $this->index();
        }
    }

    
}