<?php

namespace Core\Router;

class Router {


    private $requestingModes;
    private static $_instance;

    public function __construct() {
        $this->requestingModes = array('admin' => 'admin','api' => 'api');
    }

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Router();
        }
        return self::$_instance;
    }

    public function run(){
        
        if(isset($_GET['p'])){
            $page = $_GET['p'];
        } else {
            $page = 'log.index';
        }
        
        $pageExploded = explode('.', $page);
        
        if($pageExploded[0] === $this->requestingModes['admin']){
            $controller = 'App\Controller\Admin\\' . ucfirst($pageExploded[1]) . 'Controller';
            $action = $pageExploded[2];
        } else if($pageExploded[0] === $this->requestingModes['api']){
            $controller = 'App\Controller\Admin\\' . ucfirst($pageExploded[1]) . 'Controller';
            $action = $this->getAction();
        } else {
            $controller = 'App\Controller\\' . ucfirst($pageExploded[0]) . 'Controller';
            $action = $pageExploded[1];
        }

        if(class_exists($controller)){
            $controller = new $controller();
            if(method_exists($controller,$action)){
                if(sizeof($pageExploded) === 3){
                    $controller->$action($pageExploded[2]);
                } else {
                    $controller->$action();
                }
            } else {
                header('Location: index.php');
            }
        } else {
            header('Location: index.php');
        }
    }

    private function getAction(){
        switch($_SERVER["REQUEST_METHOD"]){
            case 'GET':
                $action = "list";
            break;
            
            case 'PATCH':
                $action = "edit";
            break;
            
            case 'POST':
                $action = "add";
            break;
            
            case 'DELETE':
                $action = "delete";
            break;
            
        }
        return $action;
    }
}