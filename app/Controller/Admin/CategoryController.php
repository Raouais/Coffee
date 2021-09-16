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
                $title = "Il n'y a aucune catégorie sur l'identifiant ".$_GET['id'];
            }
        } else {
            $hasMany = sizeof($categories->all()) > 1;
            $title = "Principale".( $hasMany ? 's' : '')." catégorie".( $hasMany ? 's' : '');
        }

        $this->render('admin.category.index',compact('categories','title'));
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

    public function addUnderCategory(){
        $title = "Ajout d'une catégorie";
        if(!empty($_POST)){
            $result = $this->Category->create(
                [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
                'category_id' => $_GET['category_id'],
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
        $underCategories = $this->Category->findAll($_GET['id'], 'category_id');
        $category = $this->Category->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($category);
        $this->render('admin.category.edit', compact('form','underCategories','category'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Category->delete($_POST['id']);
            return $this->index();
        }
    }

    
}