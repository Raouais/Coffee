<?php

namespace App\Controller\Admin;

class InterfaceController extends AppController{

    public function __construct(){
        parent::__construct();
        $this->loadmodel('Interface');
        $this->loadmodel('CategoryInInterface');
        $this->loadmodel('Category');
        $this->components[] = 'templates.navbar';
    }
    
    public function index(){
        $title = "Interfaces";
        $form = new \Core\HTML\Bootstrap($_POST);
        $interfaces = $this->Interface->all();   
        $this->render('admin.interface.index',compact('interfaces','form','title'));
    }

    public function show(){
        
    }

    public function add(){
        if(!empty($_POST)){

            if($this->isInterfaceExist($_POST['name'])){
                $error = "L'interface ".$_POST['name']." existe déjà";
            } else {
                if($_POST['name'] !== ""){

                    $result = $this->Interface->create(
                        [
                            'name' => $_POST['name'],
                        ]);

                    if($result){
                        $interfaceId = $this->Interface->find($_POST['name'],'name')->id;
                        foreach($this->getCategoriesID($_POST) as $id){
                            $this->CategoryInInterface->create([
                                'category_id' => $id,
                                'interface_id' => $interfaceId
                            ]);
                        }
                    }   
                    return $this->index();
                } else {
                    $error = "Tout les champs sont requis.";
                }
            }
        }
        $categories = $this->Category->AllTopCategories();
        $form = new \Core\HTML\Bootstrap($_POST);
        $this->render('admin.interface.edit', compact('form','error','categories'));

    }


    public function edit(){

        if(!empty($_GET)){
            $interface = $this->Interface->find($_GET['id'], 'id');
            $form = new \Core\HTML\Bootstrap($interface);
        }

        if(!empty($_POST)){
            if($this->isInterfaceExist($_POST['name'])){
                $error = "L'interface ".$_POST['name']." existe déjà";
            } else {
                if($_POST['name'] !== ""){

                    $result = $this->Interface->update(
                        $interface->id, [
                        'name' => $_POST['name'],
                    ]);

                    if($result){
                        $occurs = $this->CatagoryInInterface->findAll($interface->id, 'interface_id');
                        
                        for($i = 0; $i < $occurs; $i++){
                            $this->CategoryInInterface->deleteBy($interface->id,'interface_id');
                        }
    
                        foreach($this->getCategoriesID($_POST) as $id){
                            $this->CategoryInInterface->create([
                                'category_id' => $id,
                                'interface_id' => $interface->id
                            ]);
                        }
                    }

                } else {
                    $error = "Tout les champs sont requis.";
                }
            }
            if($result){
               return $this->index();
            }

        }
        $categories = $this->Category->AllTopCategories();
        $this->render('admin.interface.edit', compact('form','error','categories'));
    }

    public function delete(){
        if(!empty($_GET)){
            $occurs = sizeof($this->CatagoryInInterface->findAll($_GET['id'], 'interface_id'));
                    
            for($i = 0; $i < $occurs; $i++){
                $this->CategoryInInterface->deleteBy($_GET['id'],'interface_id');
            }

            $this->Interface->delete($_GET['id']);
            return $this->index();
        }
    }

    private function isInterfaceExist($name){
        if($this->Interface->find($name,'name'))
            return true;
        return false;
    }

    private function getCategoriesID($posts){
        $categoriesIDInInterface = [];
        foreach($posts as $p => $post){
            if(is_numeric($p)){
                $categoriesIDInInterface[] = $p;
            }
        }
        return $categoriesIDInInterface;
    }
}