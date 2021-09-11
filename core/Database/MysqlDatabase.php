<?php 

namespace Core\Database;

use \PDO;

class MysqlDatabase extends Database{

    private  $db_name;
    private  $db_user;
    private  $db_pass;
    private  $db_host;
    private  $pdo;

    public function __construct(string $db_name, string $db_user = 'root', string $db_pass = '', string $db_host = 'localhost'){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
        $this->getPDO();
    }

    private function getPDO(): PDO{
        if($this->pdo === null){
            $pdo = new PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_user, $this->db_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $statement, string $class_name = null, bool $one = false) {
        $req = $this->pdo->prepare($this->escape($statement));
        $res = $req->execute();
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0 
        ){
            return $res;
        }
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one){
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;

    }

    public function prepare(string $statement, array $attributs, string $class_name = null, bool $one = false){
        $req = $this->pdo->prepare($this->escape($statement));
        $res = $req->execute($attributs);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0 
        ){
            return $res;
        }
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one){
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
        }

        public function lastInsertId(){
            return $this->pdo->lastInsertId();
        }
}