<?php

class Usuario {
    private $conn;
    private $table_name = "tbautor";

 
    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTodos(){
        $sql = "Select * from ".$this->table_name;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function registrar($nome, $sexo, $email, $senha) {
      
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT); // Criptografar a senha
        $query = "INSERT INTO " . $this->table_name . " (nome, sexo, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $sexo, $email, $senha_hash]);
        return $stmt;
    }
    


    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
    
    public function criar($nome, $sexo, $email, $senha) {
        return $this->registrar($nome, $sexo, $email, $senha);
    }


    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idautor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function atualizar($id, $nome, $sexo, $email) {
        $query = "UPDATE " . $this->table_name . " SET nome = ?, sexo = ?, email = ? WHERE idautor = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $sexo, $email, $id]);
        return $stmt; 
    }


    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idautor = ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute([$id]); 
        return $stmt; 
    }
}

?>