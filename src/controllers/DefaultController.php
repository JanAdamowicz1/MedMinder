<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index(){
        $this->render('startPage');
    }

    public function signUp(){
        $this->render('signUp');
    }

    public function addCustomMed(){
        $this->render('addCustomMed');
    }

    public function addMed(){
        $this->render('addMed');
    }

    public function startPage(){
        $this->render('startPage');
    }

    public function logout(){
        $this->render('logout');
    }

    public function dosageSchedule(){
        $this->render('dosageSchedule');
    }

    public function settings(){
        $this->render('settings');
    }
}

?>