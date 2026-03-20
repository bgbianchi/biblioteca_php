<?php
// models/Libro.php

class Libro {
    private $conn;
    private $table_name = "libros";

    public $id;
    public $titulo;
    public $autores;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Leer todos los libros
    public function leer() {
        $query = "SELECT id, titulo, autores FROM " . $this->table_name . " ORDER BY titulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo libro
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autores) VALUES (:titulo, :autores)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autores", $this->autores);

        return $stmt->execute();
    }

    // Obtener un libro por ID (para edición)
    public function leerUno() {
        $query = "SELECT titulo, autores FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->titulo = $row['titulo'];
            $this->autores = $row['autores'];
            return true;
        }
        return false;
    }

    // Actualizar libro
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, autores = :autores WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":autores", $this->autores);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    /**
     * Eliminar libro respetando la regla de negocio:
     * No se puede eliminar si posee un préstamo asociado.
     */
    public function borrar() {
        // Verificar si existen préstamos relacionados
        $checkQuery = "SELECT COUNT(*) FROM prestamos WHERE libro_id = ?";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([$this->id]);
        
        if ($checkStmt->fetchColumn() > 0) {
            return false; // Bloquear eliminación
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }
}
