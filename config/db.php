<?php
class Database {
private $host="localhost";
private $dbname="application";
private $username="root";
private $password="Teerapon777";

public $conn;
public function getConnection(){
    try{

        $this->conn =new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
                                            $this->username,$this->password);
         $this->conn->exec("set names utf8");
    }catch(PDOException $e)
    {
        echo"Connection eroor :" .$e->getMessage();

    }
   return $this->conn;
   
}
}
?>