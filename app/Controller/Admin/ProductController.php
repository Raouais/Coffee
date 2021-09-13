<?php

namespace App\Controller\Admin;

class ProductController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Product');
        $this->template = 'admin';
    }

    public function index(){
        $products = $this->Product->all();   
        $this->render('admin.product.index',compact('products'));
    }

    public function add(){
        if(!empty($_POST)){
            $result = $this->Product->create(
                [
                'label' => $_POST['label'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'threshold' => $_POST['threshold'],
                'category_id' => $_POST['category_id'],
                'imagePath' => $_POST['imagePath'],
            ]);
                return $this->index();
        }
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.product.edit', compact('form'));

    }


    public function edit(){
        if(!empty($_POST)){
            $result = $this->Product->update(
                $_GET['id'], [
                    'label' => $_POST['label'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price'],
                    'threshold' => $_POST['threshold'],
                    'category_id' => $_POST['category_id'],
                    'imagePath' => $_POST['imagePath'],
            ]);
            if($result){
               return $this->index();
            }

        }
        $product = $this->Product->find($_GET['id'], 'id');
        $form = new \Core\HTML\Bootstrap($product);
        $this->render('admin.product.edit', compact('form'));
    }

    public function delete(){
        if(!empty($_POST)){
            $result = $this->Product->delete($_POST['id']);
            return $this->index();
        }
    }


}