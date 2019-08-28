<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db; 

class MainController extends Controller {
    public function indexAction() {
        // $db = new Db;
        // $params = [
        //     'id' => 2,
        // ];
        // $data=$db->column('SELECT email FROM users WHERE id = :id', $params);
        // debug($data);
        $result = $this -> model -> getNews();
        $vars = [
            'news' => $result,
        ];
        $this -> view -> render('Главная страница', $vars );
    }
    public function contactAction() {
        echo 'Контакты ';
    }
}