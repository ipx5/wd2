<?php

session_start();

define ('DS', DIRECTORY_SEPARATOR); 
define ('ROOT', dirname(dirname(__FILE__))); 

require_once(ROOT.DS.'app'.DS.'lib'.DS.'init.php');
//require_once(ROOT.DS.'app'.DS.'lib'.DS.'router.class.php');

$router = new Router;

$router->run();