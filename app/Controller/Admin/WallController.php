<?php

namespace App\Controller\Admin;

class WallController extends \App\Controller\AppController{

    public function __construct(){
        parent::__construct();
        header('content-Type: application/json');
        $this->loadmodel('Wall');
    }


    public function list($room_id){
        $tables = $this->Wall->findAll($room_id,'room_id');
        $this->response($tables);
    }

    public function add($room_id){
        $body = $this->getBody();
        $res = $this->Wall->create(
                [
                'position_x' => $body['position_x'],
                'position_y' => $body['position_y'],
                'width' => $body['width'],
                'height' => $body['height'],
                'room_id' => $room_id,

            ]);
            $this->response($res);
    }

    public function edit($room_id){
        $body = $this->getBody();
        $this->Wall->update( $body['id'],
                [
                    'position_x' => $body['position_x'],
                    'position_y' => $body['position_y'],
                    'width' => $body['width'],
                    'height' => $body['height'],
                    'room_id' => $room_id,
            ]);
    }

    public function delete(){
        $this->Wall->delete($this->getBody()['id']);
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

