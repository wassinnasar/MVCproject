<?php

namespace app\controllers;
 
use app\core\Controller;
//use app\lib\Db;
class MainController extends Controller{

  
    public function indexAction(){
      $this->view->render('Главаная страница',$vars);
    }
 }
?>