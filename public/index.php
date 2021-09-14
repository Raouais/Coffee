<?php
define('ROOT', dirname(__DIR__).'/'); //define() permet de créer une constante
require ROOT.'app/App.php'; 
require ROOT. 'core/Router/Router.php';
use \Core\Router\Router;
App::load();
Router::getInstance()->run();