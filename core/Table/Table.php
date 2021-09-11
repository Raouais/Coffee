<?php
 
namespace Core\Table;

use Core\Database\MysqlDatabase;

 
class Table{

    protected $table;
    protected $db;

    public function __construct(MysqlDatabase $db){

        $this->db = $db;

        if(is_null($this->table)){
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '\\', $class_name)).'s';
        }
        
    }

    public function all(){
        return $this->query("SELECT * FROM `{$this->table}` ");
    }

    public function findAll($what,$where){
        return $this->query("SELECT * FROM  `{$this->table}`  WHERE {$where} = ?", [$what]);
    }

    public function find($what,$where){
        return $this->query("SELECT * FROM  `{$this->table}`  WHERE {$where} = ?", [$what], true);
    }      
    
    public function update($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(', ',$sql_parts);
        return $this->query("UPDATE `{$this->table}` SET $sql_part WHERE id = ?", $attributes, true);
    }
    
    public function create($fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(', ',$sql_parts);
        return $this->query("INSERT INTO `{$this->table}` SET $sql_part", $attributes, true);
    }

    public function delete($id){
        return $this->query("DELETE FROM `{$this->table}` WHERE id = ?", [$id], true);
    }

    public function extract($key, $value){
        $records = $this->all();
        $return = [];
        foreach ($records as $k => $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }   
    /**
     * return les requetes preparer ou requetes directes
     * $attributs à null parce qu'ils sont optionnelle
     * $one initialiser a false si on veut plusieur enregistrements
     * le changment de table par entity sert à instancier une classe (classe qui perme d'avoir des articles)
     */
    public function query($statement, $attributs = null, $one = false){
        if($attributs){
            return $this->db->prepare(
                $statement, 
                $attributs, 
                str_replace('Table','Entity', get_class($this)),
                $one
            );
        } else {
            return $this->db->query(
                $statement, 
                str_replace('Table','Entity', get_class($this)), 
                $one
            );
        }
    }
 
}