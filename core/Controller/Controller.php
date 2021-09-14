<?php

namespace Core\Controller;

class Controller{


    protected $viewPath;
    protected $template;
    protected $components;


    protected function render($view, $variables = []){
        ob_start();
        extract($variables);
        foreach($this->components as $v){
            require ($this->viewPath . str_replace('.','/', $v) . '.php');
        }
        require ($this->viewPath . str_replace('.','/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/'. $this->template . '.php');
    }

    protected function response($res){
        $retour["results"] = $res;
        echo json_encode($retour);
    }

    protected function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    protected function notFound(){
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

    
}