<?php

namespace Core\Router;

class Router {


    private $requestingModes;
    private static $_instance;

    public function __construct() {
        $this->requestingModes = array('admin' => 'admin','api' => 'api', 'admin_api' => 'adapi');
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
        
        if($pageExploded[0] === $this->requestingModes['admin'] || $pageExploded[0] === $this->requestingModes['admin_api']){
            $controller = 'App\Controller\Admin\\' . ucfirst($pageExploded[1]) . 'Controller';
            $action = $pageExploded[2];
        } else if($pageExploded[0] === $this->requestingModes['api']){
            $controller = 'App\Controller\\' . ucfirst($pageExploded[1]) . 'Controller';
            $action = $pageExploded[2];            
        } else {
            $controller = 'App\Controller\\' . ucfirst($pageExploded[0]) . 'Controller';
            $action = $pageExploded[1];
        }

        if(class_exists($controller)){
            $_SESSION['auth_api'] = "ok";
            $controller = new $controller();
            if( sizeof($pageExploded) === 4){
                $controller->$action($pageExploded[3]);
            } else {
                $controller->$action();
            }
        }

    }

}