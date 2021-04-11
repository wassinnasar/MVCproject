<?php


namespace app\lib;
use PDO;
class Db{

    protected $dbh;
    public function __construct(){
       $conf = require 'app/config/db.php';
       $this->dbh = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['dbname'].'',$conf['user'],$conf['password']);
       var_dump($conf);
    }


    public function query($sql,$params = []){
    $stmt = $this->dbh->prepare($sql);
    if(!empty($params)){
        foreach($params as $key => $value){
        $stmt->bindValue(':'.$key, $value);
        }
    }
    $stmt->execute();
    return $stmt;
    }

    public function row($sql,$params = []){
$result = $this->query($sql,$params);
return $result->fetchAll();
    }
    public function column($sql,$params = []){
        $result = $this->query($sql,$params);
        return $result->fetchColumn();
    }
}
?>