<?php
// models/Lector.php

class Lector {
    private $conn;
    private $table_name = "lectores";

    public $id;
    public $nombre;
    public $dni;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar todos los lectores
    public function leer() {
        $query = "SELECT id, nombre, dni, email FROM " . $this->table_name . " ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Registrar un nuevo lector
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, dni, email) VALUES (:nombre, :dni, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":email", $this->email);

        return $stmt->execute();
    }

    // Obtener datos de un lector específico
    public function leerUno() {
        $query = "SELECT nombre, dni, email FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nombre = $row['nombre'];
            $this->dni = $row['dni'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    // Actualizar datos del lector
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, dni = :dni, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    /**
     * Eliminar lector respetando la regla de negocio:
     * No es posible eliminar lectores que posean un préstamo asociado.
     */
    public function borrar() {
        // Validación de préstamos asociados
        $checkQuery = "SELECT COUNT(*) FROM prestamos WHERE lector_id = ?";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([$this->id]);
        
        if ($checkStmt->fetchColumn() > 0) {
            return false; // El lector tiene historial o préstamos activos
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }
}
