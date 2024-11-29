<?php
class Noticia
{
    private $conn;
    private $table_name = "tbnoticia";


    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function registrar($titulo, $data, $noticia, $foto, $autor)
    {
        $query = "INSERT INTO " . $this->table_name . " (titulo, data, noticia, foto, autor) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titulo, $data, $noticia, $foto, $autor]);
        return $stmt;
    }

    public function ler()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function lerPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idnoticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarTodos()
    {
        $sql = "SELECT tbnoticia.idnoticia, tbnoticia.titulo, tbnoticia.data, tbnoticia.noticia, tbnoticia.foto,  tbusuarios.nome AS autor 
                FROM tbnoticia 
                JOIN tbusuarios ON tbnoticia.autor = tbusuarios.idusuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt; // Retorna o PDOStatement para ser usado com fetch()
    }

    public function atualizar($id, $titulo, $data, $noticia, $foto)
    {
        $query = "UPDATE " . $this->table_name . " SET titulo = ?, data = ?, noticia = ?, foto = ? WHERE idnoticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titulo, $data, $noticia, $foto, $id]);
        return $stmt;
    }


    public function deletar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idnoticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}
