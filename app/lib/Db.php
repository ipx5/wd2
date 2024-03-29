<?php
namespace app\lib;
use PDO;
class DB {
    protected $db;

    public function __construct(){
        $config =  require 'app/config/db.php';
        $dsn= "mysql:host=$host;dbname=$db";
        try{
            $this -> db = new PDO($dsn, $username, $password);
            if ( $this -> db ) {
            echo "Connected to the <strong>$db</strong> database successfully!";
            }
        } catch (PDOException $e){
            echo $e->getMessage();
            }
        //$this -> db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['password']);
        //$this->db=new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].'', $config['user'], $config['password']);
    }
    public function query($sql, $params=[]){
        $stmt = $this->db->prepare($sql);
        if (!empty($params)){
            foreach ($params as $key => $value) {
                echo '<p>'.$key.'=>'.$value.'</p>';
                $stmt->bindValue(':'.$key,$value);
            }
        }
        
        $stmt->execute();
        return $stmt;


    }
    public function row($sql, $params=[]){
        $result=$this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function column($sql, $params=[] ){
        $result=$this->query($sql, $params);
        return $result->fetchColumn();
    }
}