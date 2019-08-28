<?php
namespace app\core;

class View {
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this -> route = $route;
        //debug($this->layout);
        $this -> path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = []){
        //debug($vars);
        extract($vars);
        $path_view='../app/views/'.$this -> path.'.php';
        $path_layout='../app/views/layouts/'.$this -> layout.'.php';
        // debug($path_layout);
        if(file_exists($path_view)){
            ob_start();
            require $path_view;
            $content = ob_get_clean();
            require $path_layout;
        }
    }
    public function redirect($url){
        header('location: '.$url);
        exit;
    }
    public function errorCode($code){
        http_response_code($code);
        $path_errors = '../app/views/errors/'.$code.'.php';
        if(file_exists($path_errors)){
            require $path_errors;
        }
        exit;
    }
    public function message($status, $message){
        exit(json_encode(['status' => $status, 'message' => $message ]));
    }
    public function location($url){
        exit(json_encode(['url' => $url]));
    }
}