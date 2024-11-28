<?php
 
class Database{
    private $host = "Localhost";
    // nome do bdd
    private $db_name = "db_noticias";
    private $username= "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this ->conn =null;
        try{
            $this->conn =new PDO("mysql:host=" .$this->host.";dbname=". $this->db_name,$this->username,$this->password);
        }catch (PDOException $exeption){
            echo "Erro de conexão: ".$exeption->getMessage();
        }
        return $this->conn;
    }
}

?>