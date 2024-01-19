<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index(){
        $this->render('startPage');
    }

    public function signUp(){
        $this->render('signUp');
    }

    public function startPage(){
        $this->checkSession();
        $this->render('startPage');
    }

    public function logout(){
        $this->checkSession();
        $this->render('logout');
    }
}

?>