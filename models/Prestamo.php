<?php
// models/Prestamo.php

class Prestamo {
    private $conn;
    private $table_name = "prestamos";

    public $id;
    public $libro_id;
    public $lector_id;
    public $fecha_prestamo;
    public $fecha_devolucion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Listar préstamos con nombres de libros y lectores (Join para la vista)
    public function leer() {
        $query = "SELECT p.id, lib.titulo as libro, lec.nombre as lector, 
                         p.fecha_prestamo, p.fecha_devolucion 
                  FROM " . $this->table_name . " p
                  JOIN libros lib ON p.libro_id = lib.id
                  JOIN lectores lec ON p.lector_id = lec.id
                  ORDER BY p.fecha_prestamo DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Regla de Negocio: No es posible registrar un préstamo sobre un libro 
     * que posea un préstamo asociado sin fecha de devolución registrada.
     */
    public function crear() {
        $checkQuery = "SELECT COUNT(*) FROM " . $this->table_name . " 
                       WHERE libro_id = :libro_id AND fecha_devolucion IS NULL";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":libro_id", $this->libro_id);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            return false; // El libro ya está prestado
        }

        $query = "INSERT INTO " . $this->table_name . " (libro_id, lector_id, fecha_prestamo) 
                  VALUES (:libro_id, :lector_id, :fecha_prestamo)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":libro_id", $this->libro_id);
        $stmt->bindParam(":lector_id", $this->lector_id);
        $stmt->bindParam(":fecha_prestamo", $this->fecha_prestamo);

        return $stmt->execute();
    }

    /**
     * Regla de Negocio: La fecha de préstamo debe ser menor o igual a la de devolución.
     */
    public function actualizar() {
        // Primero recuperamos la fecha de préstamo para validar
        $sqlFecha = "SELECT fecha_prestamo FROM " . $this->table_name . " WHERE id = ?";
        $stmtFecha = $this->conn->prepare($sqlFecha);
        $stmtFecha->execute([$this->id]);
        $fPrestamo = $stmtFecha->fetchColumn();

        if ($this->fecha_devolucion < $fPrestamo) {
            return false; // Error: Devolución anterior al préstamo
        }

        $query = "UPDATE " . $this->table_name . " 
                  SET fecha_devolucion = :fecha_devolucion 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":fecha_devolucion", $this->fecha_devolucion);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function borrar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }
}
