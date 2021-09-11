<?php

namespace Core\Auth;


use Core\Database\MysqlDatabase;

class DBAuth{

    private $db;

    public function __construct(MysqlDatabase $db){
        $this->db = $db;
    }

    public function getUserId(){
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }

    public function login($user_name,$password){
        $user = $this->db->prepare("SELECT * FROM user WHERE name = ? ",[$user_name], null, true);
        if(!empty($user->id) && password_verify($password, $user->password)){            
            $_SESSION['auth_id'] = $user->id;
            $_SESSION['auth_role'] = $user->role_id;
            return $user;
        } 
    }

    public function sign($user){
        $_SESSION['auth_id'] = $user->id;   
        return true;
}

    public function logged(){
        return isset($_SESSION['auth_id']) || isset($_SESSION['auth_api']);
    }
}