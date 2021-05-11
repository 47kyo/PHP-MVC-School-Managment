<?php
class DatabaseConnection
{
 
 
    private $host ='localhost';
    private $dbname = 'school';
    private $username = 'root';
    private $password = '';
 
 

    public $con = null;
 
    function __construct(){
 
        $this->connect();
    }
 
    function connect(){
 
        try{
 
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username, $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
 
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
 
        }catch(PDOException $e){
 
 
            echo 'We\'re sorry but there was an error while trying to connect to the database'.$e->getMessage();
            file_put_contents('connection.errors.txt', $e->getMessage().PHP_EOL,FILE_APPEND);
 
        }
    }
}
 
//$dbcon=new DatabaseConnection();
//$dbcon->connect();
?>