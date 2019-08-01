<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug ($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
};

spl_autoload_register( function ($class) {

    $lib_path = ROOT.DS.'app'.DS.'lib'.DS.strtolower($class).'.class.php';
    $controllers_path = ROOT.DS.'app'.DS.'controllers'.DS.strtolower($class).'.controller.php';
    $model_path = ROOT.DS.'app'.DS.'models'.DS.strtolower($class).'.php';
    if( file_exists($lib_path) ){
        require_once($lib_path);
    } elseif ( file_exists($controllers_path) ) {
        require_once($controllers_path);
    } elseif ( file_exists($model_path) ) {
        require_once($model_path);
    } else {
        throw new Exception('Failed to include class: '.$class);
    }
});
