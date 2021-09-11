<?php

namespace App\Controller\Admin;

class BoardController extends \App\Controller\AppController{

    public function __construct(){
        parent::__construct();
        header('content-Type: application/json');
        $this->loadmodel('Board');
    }


    public function list($room_id){
        $tables = $this->Board->findAll($room_id,'room_id');
        $this->response($tables);
    }

    public function add($room_id){
        $body = $this->getBody();
        $res = $this->Board->create(
                [
                'number' => $body['number'],
                'position_x' => $body['position_x'],
                'position_y' => $body['position_y'],
                'format' => $body['format'],
                'size' => $body['size'],
                'room_id' => $room_id,

            ]);
            $this->response($res);
    }

    public function edit($room_id){
        $body = $this->getBody();
        $this->Board->update( $body['id'],
                [
                'number' => $body["number"],
                'position_x' => $body['position_x'],
                'position_y' => $body['position_y'],
                'size' => $body['size'],
                'room_id' => $room_id,
            ]);
    }

    public function delete(){
        $this->Board->delete($this->getBody()['id']);
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

