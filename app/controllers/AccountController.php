<?php
namespace app\controllers;
use app\core\Controller;

class AccountController extends Controller {

    public function loginAction() {
        if( !empty($_POST) ){
            $this -> view -> location ('/acoount/register');
        }
        $this -> view -> render('Вход');
    }
    public function registerAction() {

        $this -> view -> render('Регистрация');
    }
}
