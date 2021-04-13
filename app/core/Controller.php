<?php

namespace app\core;

use app\core\View;

abstract class Controller{

  public $route;
  public $view;
  public $model;
  public $acl;

  public function __construct($route){
    $this->route = $route;
    //$_SESSION['authorized']['id'] = 1;
    if(!$this->checkAcl()){
      View::errorCode(403);
    }
    $this->checkAcl();
    $this->view = new View($route);
    $this->model = $this->loadModel($route['controller']);
    var_dump($this->model);
  }

  public function loadModel($name){
    $path = 'app\models\\'.ucfirst($name);
    if(class_exists($path)){
      return new $path;
    }
  }
  public function checkAcl(){
    $this->acl = require'app/acl/'.$this->route['controller'].'.php';
    if($this->isAcl('all')){
      return true;
    }
    elseif(isset($_SESSION['authorized']['id'])and $this->isAcl('authorized')){
      return true;
    }
    elseif(!isset($_SESSION['authorized']['id'])and $this->isAcl('guest')){
      return true;
    }
    return false;
  }
  public function isAcl($key){
    return in_array($this->route['action'],$this->acl[$key]);
  }
}
?>