<?php

//namespace app\lib;

class Router {
    protected $routes =[];
    protected $params = [];
    
    public function __construct() {
        $arr = require(ROOT.DS.'app'.DS.'config'.DS.'routes.php');
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
        //debug($this->routes);
    }

    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route]=$params;
        
    }
    
    public function match() {
        //debug($_SERVER);
        $url=trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this -> routes as $route => $params) {
            if ( preg_match($route, $url, $matches) ){
                $this -> params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() {
        if ( $this->match() ) {
            $controller = ROOT.DS.'app'.DS.'controllers'.DS.ucfirst($this->params['controller']).'.controller.php';
            //$controller = 'app\controllers\\'.ucfirst($this->params['controller']).'.controller.php';
            if( class_exists($controller) ){
                echo 'OK';
            } else {
                echo 'Не найден: '.$controller;
            }
        } else {
            echo 'маршрут не найден';
        }
    }


    /*
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $method_prefix;
    protected $language;
    
    public function getUri()
    {
        return $this->uri;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        $this->params;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        $routes = Config::get('routes');
        $this -> route=Config::get('default_route');
        $this -> method_prefix = $routes[$this->route];
        $this -> language = Config::get('default_language');
        $this -> controller = Config::get('default_controller');
        $this -> action = Config::get('default_action');
        
        $uri_parts = explode('?', $this->uri);
        $path = $uri_parts[0];
        $path_parts = explode('/', $path);

        if ( count($path_parts) ){
            if ( in_array(strtolower(current($path_parts)), array_keys($routes)) ){
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = $routes[$this->route];
                array_shift($path_parts);
                
            }
        }
    }

    */
}