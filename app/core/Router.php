<?php

namespace app\core;

use app\core\View;
class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct(){
       $arr = require 'app/config/routes.php';
       foreach($arr as $key => $val){
          $this->add($key,$val);
       }
    }
    public function add($route, $params){
    $rout = '#^'.$route.'$#';
    $this->routes[$rout] = $params;
    }
    public function match(){
       $url = trim($_SERVER['REQUEST_URI'],'/');
       foreach($this->routes as $rout=>$params){
           if(preg_match($rout,$url,$matches)){
              $this->params = $params;
              return true;
           }
       }
       return false;
    }
    public function run(){
        if($this->match()){
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($path)){
                $action = $this->params['action'].'Action';
                if(method_exists($path,$action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                }
                else{
                    View::errorCode(404);
                }
            }
            else{
                View::errorCode(404);
            }
       }
       else{
        View::errorCode(500);
       }
    }
    
}
?>