<?php
 
namespace App\Table;

use Core\Table\Table;

class ProductTable extends Table {

    protected $table = "product";

    public function getByCategory($id){
        return $this->query("SELECT * 
        FROM `{$this->table}`
        WHERE category_id 
        IN (SELECT id FROM category WHERE category_id = ?) 
        OR category_id 
        IN (SELECT id FROM category WHERE id = ?)",[$id,$id]);
    }
    
}