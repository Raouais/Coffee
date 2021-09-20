<?php

namespace App\Controller\Admin;

class CategoryController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Category');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $form = new \Core\HTML\Bootstrap();
        $categories = $this->Category;
        if(!empty($_GET['id'])){
            $category = $categories->find($_GET['id'],'id');
            $hasMany = sizeof($categories->findAll($_GET['id'],'category_id'));
            if($hasMany > 0){
                $title = "Sous catégorie".( $hasMany > 1 ? 's' : '')." de ". $this->Category->find($_GET['id'],'id')->name;
            } elseif(isset($category)) {
                header("Location: index.php?p=admin.category.index&id=".$category->category_id);
            } else {
                header("Location: index.php?p=admin.category.index");
            }
        } else {
            $hasMany = sizeof($categories->all()) > 1;
            $title = "Principale".( $hasMany ? 's' : '')." catégorie".( $hasMany ? 's' : '');
        }
        $this->render('admin.category.index',compact('categories','title','form'));
    }

    public function add(){
        $title = "Ajout d'une catégorie";
        if(!empty($_GET['id'])){
            $category = $this->Category->find($_GET['id'],'id');
            $title = "Ajout d'une sous catégorie de ".$category->name;
            $id = $_GET['id'];
        }
        if(!empty($_POST)){
            if($_POST['name'] === "" || $_POST['color'] === ""){
                $error = "Tout les champs sont obligatoires";
            } else {
                $this->Category->create(
                    [
                    'name' => ucfirst($_POST['name']),
                    'color' => $_POST['color'],
                    'category_id' => isset($id) ? $id : 0,
                ]);
                return $this->index();
            }
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.category.edit', compact('form','category','title','error'));
    }

    public function edit(){
        if(!empty($_GET)){
            $category = $this->Category->find($_GET['id'], 'id');
            $title = "Edition de la catégorie: ".$category->name;
            if($category->category_id != 0){
                $title = "Edition de la sous catégorie ".$category->name." de ".$this->Category->find($category->category_id, 'id')->name;
            }
        }
        if(!empty($_POST)){
            $result = $this->Category->update(
                $_GET['id'], [
                'name' => $_POST['name'],
                'color' => $_POST['color'],
            ]);
            if($result){
                return $this->index();
            }    
        }
        $form = new \Core\HTML\Bootstrap($category);
        $this->render('admin.category.edit', compact('form','category','title','error'));
    }

    public function delete(){
        if(!empty($_GET)){
            if(!empty($this->Category->find($_GET['id'],'category_id'))){
                header("Location: index.php?p=admin.category.index");
            } else {
                $this->Category->delete($_GET['id']);
                return $this->index();
            }
        }
    }

    
}