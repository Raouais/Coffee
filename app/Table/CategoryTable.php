<?php
 
namespace App\Table;

use Core\Table\Table;

class CategoryTable extends Table {


    protected $table = "category";

    public function allTopCategories($id = 0){
        return $this->query("SELECT * FROM `{$this->table}` WHERE category_id = ?",[$id]);
    }

    public function isTopCategory($id){
        return !empty($this->query("SELECT * FROM `{$this->table}` WHERE category_id = ? and id = ?",[0,$id]));
    }
    
}