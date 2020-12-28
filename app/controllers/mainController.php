<?php

class mainController
{
    private $route;
    private $viewPath;
    private $className;

    private $header_servers = 6;
    private $header_active_servers = 4;
    private $header_errors = 87;
    private $header_warnings = 256;


    //Immer Ausgeführt
    private function enable()
    {
        $db = new database();
    }


    public function __construct($route)
    {
        $this->route = $route;
        $this->viewPath = ROOT_PATH . "/app/views/" . $this->route . ".phtml";
        $tmp = explode("/", $this->route);
        $this->className = end($tmp) . "Controller";
        $this->render();
    }

    private function render()
    {
        ob_start();
        $this->enable();
        require_once($this->viewPath);
        $view = ob_get_contents();
        ob_get_clean();
        echo $view;
    }

}