<?php

namespace App\Controller\Admin;

class ProductController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Product');
        $this->loadmodel('Category');
        $this->components[] = 'templates.navbar';
    }

    public function index(){
        $products = $this->Product->all();   
        $selected = 0;
        if(!empty($_POST) && isset($_POST['category'])){
            if($_POST['category'] == 0){
                $products = $this->Product->all();   
                $selected = 0;
            } else {
                $products = $this->Product->getByCategory($_POST['category']);
                $selected = $_POST['category'];
            }
        } 
        $form = new \Core\HTML\Bootstrap();
        $title = "Produits";
        $categories = $this->Category;
        $this->render('admin.product.index',compact('form','products','categories',"title", 'selected'));
    }

    public function add(){
        $form = new \Core\HTML\Bootstrap($_POST);
        $title = "Ajout d'un produit";
        $categories = $this->Category;
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            if($_POST['label'] == "" || $_POST['price'] == "" || $_POST['quantity'] == ""){
                $error = "Tout les champs sont requis";
            } elseif($isImageUploaded){
                $this->Product->create(
                    [
                    'label' => $_POST['label'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price'],
                    'threshold' => $_POST['threshold'],
                    'category_id' => $_POST['category_id'],
                    'image' => $image,
                ]);
                return $this->index();
            }
        }
        $this->render('admin.product.edit', compact('form','title','error','categories'));

    }


    public function edit(){
        $categories = $this->Category;
        if(!empty($_GET)){
            $product = $this->Product->find($_GET['id'], 'id');
            $form = new \Core\HTML\Bootstrap($product);
        }
        if(!empty($_POST)){
            $isImageUploaded = $form->uploadImage($error,$image);
            $result = $this->Product->update(
                $_GET['id'], [
                    'label' => $_POST['label'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price'],
                    'threshold' => $_POST['threshold'],
                    'category_id' => $_POST['category_id'],
                    'image' => isset($product) && !$isImageUploaded ? $product->image : $image,
            ]);
            if($result)
                return $this->index();
        }
        $title = "Edition du produit ".$product->label;
        $this->render('admin.product.edit', compact('form','title','error','categories'));
    }

    public function delete(){
        if(!empty($_GET)){
            $product = $this->Product->find($_GET['id'],'id');
            unlink(ROOT . 'public/uploads/'.$product->image);
            $this->Product->delete($_GET['id']);
            return $this->index();
        }
    }


}