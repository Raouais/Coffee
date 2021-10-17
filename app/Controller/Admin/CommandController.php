<?php

namespace App\Controller\Admin;

class CommandController extends \App\Controller\AppController{

    public function __construct(){
        parent::__construct();
        $this->components[] = 'templates.navbar';
        $this->loadmodel('Command');
    }

    public function index(){
        $this->render('admin.command.index');
    }

    public function list(){
        $tables = $this->Command->all();
        $this->response($tables);
    }

    public function add($room_id){
        $body = $this->getBody();
        $res = $this->Command->create(
                [
                'price' => $body['price'],
                'date' => $body['date'],
                'time' => $body['time'],
                'number' => $body['number'],
                'table_number' => $body['table_number'],
                'service_id' => $body['service_id'],
            ]);
            $this->response($res);
    } 

    public function edit($room_id){
        $body = $this->getBody();
        $this->Command->update( $body['id'],
                [
                'price' => $body['price'],
                'date' => $body['date'],
                'time' => $body['time'],
                'table_number' => $body['table_number'],
                'service_id' => $body['service_id'],
            ]);
    }

    public function delete(){
        $this->Command->delete($this->getBody()['id']);
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

