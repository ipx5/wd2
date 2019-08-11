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
        $path_view='../app/views/'.$this -> path.'.php';
        $path_layout='../app/views/layouts/'.$this -> layout.'.php';
        // debug($path_layout);
        if(file_exists($path_view)){
            ob_start();
            require $path_view;
            $content = ob_get_clean();
            require $path_layout;
        } else {
            echo 'Вид не найден: '.$this -> path;
        }
    }
}
