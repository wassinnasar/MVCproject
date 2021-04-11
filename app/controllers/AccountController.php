<?php

namespace app\controllers;
 
use app\core\Controller;
//use app\lib\Db;
class AccountController extends Controller{

  
    public function loginAction(){
      $this->view->redirect('/');
     $this->view->render('Страница логина');
    }
    public function registerAction(){
      $this->view->render('Страница регистраций');
    }
 }
?>