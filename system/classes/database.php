<?php

class database{
    public $host     = "localhost";
    public $user     = "root";
    public $dbname = "attendence";
    public $password = "";
    public $conn;
    public $result;
    public function __construct(){

        try {
            return $this->conn=new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname,$this->user, $this->password);
        }
        catch (PDOException $e){
            echo "database connection is not established".$e->getMessage();
        }
    }
    public function rowCount(){

        return $this->result->rowCount();

    }
    public function fetchall(){

        return $this->result->fetchAll(PDO::FETCH_OBJ);

    }

    public function fetch(){

        return $this->result->fetch(PDO::FETCH_OBJ);

    }
    public function query($qry, $params = []){

        if(empty($params)){
            $this->result = $this->conn->prepare($qry);
            return $this->result->execute();

        } else {
            $this->result = $this->conn->prepare($qry);
            return $this->result->execute($params);
        }

    }


}

?>
