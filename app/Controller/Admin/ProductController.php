<?php

namespace App\Controller\Admin;

class ProductController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Product');
    }

    public function index(){
        $products = $this->Product->all();
        $this->response($products);
        // $this->render('admin.product.index',compact('products'));
        // return $products;
    }


}