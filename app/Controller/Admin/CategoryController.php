<?php

namespace App\Controller\Admin;

class CategoryController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Category');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $categories = $this->Category;
        if(!empty($_GET['id'])){
            $hasMany = sizeof($categories->findAll($_GET['id'],'category_id'));
            if($hasMany > 0){
                $title = "Sous catégorie".( $hasMany > 1 ? 's' : '')." de ". $this->Category->find($_GET['id'],'id')->name;
            } else {
                header("Location: index.php?p=admin.category.index");
            }
        } else {
            $hasMany = sizeof($categories->all()) > 1;
            $title = "Principale".( $hasMany ? 's' : '')." catégorie".( $hasMany ? 's' : '');
        }
        $this->render('admin.category.index',compact('categories','title'));
    }

    public function add(){
        $title = "Ajout d'une catégorie";
        if(!empty($_POST)){
            $this->Category->create(
                [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'category_id' => 0,
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.category.edit', compact('form', 'title'));
    }

    public function addUnderCategory(){
        $title = "Ajout d'une catégorie";
        if(!empty($_POST)){
            $result = $this->Category->create(
                [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'category_id' => $_GET['id'],
            ]);
                return $this->index();
        }
        $category = 0;
        if(!empty($_GET['id'])){
            $category = $this->Category->find($_GET['id'],'id');
            $title = "Ajout d'une sous catégorie de ".$category->name;
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.category.under', compact('form','category','title'));
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
        $title = "Edition de la catégorie: ".$category->name;
        if($category->category_id != 0){
            $title = "Edition de la sous catégorie ".$category->name." de ".$this->Category->find($category->category_id, 'id')->name;
        }
        $form = new \Core\HTML\Bootstrap($category);
        $this->render('admin.category.edit', compact('form','category','title'));
    }

    public function delete(){
        if(!empty($_GET)){
            $this->Category->delete($_GET['id']);
            return $this->index();
        }
    }

    
}