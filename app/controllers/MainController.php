<?php

namespace app\controllers;
 
use app\core\Controller;
use app\lib\Db;

class MainController extends Controller{

  
    public function indexAction(){

      $db = new Db;
      $data = $db->query('SELECT name FROM users WHERE id = 1');
      echo $data;
      $this->view->render('Главаная страница',$vars);
    }
 }
?>