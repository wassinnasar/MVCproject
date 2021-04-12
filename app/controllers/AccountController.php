<?php

namespace app\controllers;
 
use app\core\Controller;
use app\lib\Db;
class AccountController extends Controller{

  
    public function loginAction(){
     // $this->view->redirect('/');
     
     $db = new Db;

     $form = '1; DELETE FROM users';
    $params = [
      'id' => $form,
    ];
     $data = $db->column('SELECT name FROM users WHERE id = :id', $params);
    // var_dump($data);
    if(!empty($_POST)){
     $this->view->message('error','Ошибка');
    }
     $this->view->render('Страница логина');
    }
    public function registerAction(){
      $this->view->render('Страница регистраций');

    }
 }
?>