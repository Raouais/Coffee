<?php

namespace App\Controller\Admin;

class CommandLineController extends \App\Controller\AppController{

    public function __construct(){
        parent::__construct();
        $this->components[] = 'templates.navbar';
        $this->loadmodel('CommandLine');
    }

    public function list(){
        $commandLines = $this->CommandLine->all();
        $this->response($commandLines);
    }

    public function add(){
        $body = $this->getBody();
        $res = $this->CommandLine->create(
                [
                'quantity' => $body['quantity'],
                'command_id' => $body['command_id'],
                'product_id' => $body['product_id'],
                'dish_id' => $body['dish_id'],
            ]);//quantity	command_id	product_id	dish_id
            $this->response($res);
    } 

    public function edit(){
        $body = $this->getBody();
        $this->CommandLine->update( $body['id'],
                [
                'quantity' => $body['quantity'],
                'command_id' => $body['command_id'],
                'product_id' => $body['product_id'],
                'dish_id' => $body['dish_id'],
            ]);
    }

    public function delete(){
        $this->CommandLine->delete($this->getBody()['id']);
    }


    public function getBody(){
        // if(!empty($_POST)) {
        //     // when using application/x-www-form-urlencoded or multipart/form-data as the HTTP Content-Type in the request
        //     // NOTE: if this is the case and $_POST is empty, check the variables_order in php.ini! - it must contain the letter P
        //     return $_POST;
        // }
        // when using application/json as the HTTP Content-Type in the request 
        $post = json_decode(file_get_contents('php://input'), true);
        
        if(json_last_error() == JSON_ERROR_NONE) {
            return $post;
        }
        return [];
    }
}