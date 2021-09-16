<?php
 
namespace App\Table;

use Core\Table\Table;

class CategoryTable extends Table {


    protected $table = "category";

    public function allTopCategories($id){
        return $this->query("SELECT * FROM `{$this->table}` WHERE category_id = ?",[$id]);
    }
    
}