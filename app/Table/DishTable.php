<?php
 
namespace App\Table;

use Core\Table\Table;

class DishTable extends Table {

    protected $table = "dish";

    public function getByMenu($id){
        return $this->query("SELECT d.id, d.name, d.price, d.image
                             FROM dish d, dishes_in_menu di, menu m 
                             WHERE m.id = ? 
                             AND m.id = di.menu_id",[$id]);
    }
    
}