<?php
// controllers/PrestamoController.php

require_once 'config/Database.php';
require_once 'models/Prestamo.php';
require_once 'models/Libro.php';
require_once 'models/Lector.php';

class PrestamoController {
    private $db;
    private $prestamo;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->prestamo = new Prestamo($this->db);
    }

    public function index() {
        $stmt = $this->prestamo->leer();
        $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/prestamos/index.php';
    }

    public function crear() {
        if ($_POST) {
            $this->prestamo->libro_id = $_POST['libro_id'];
            $this->prestamo->lector_id = $_POST['lector_id'];
            $this->prestamo->fecha_prestamo = $_POST['fecha_prestamo'];

            // El modelo valida si el libro ya está prestado (sin fecha de devolución)
            if ($this->prestamo->crear()) {
                header("Location: index.php?action=prestamos&msg=success");
            } else {
                // Error: El libro no está disponible o datos inválidos
                header("Location: index.php?action=prestamos_nuevo&msg=unavailable");
            }
            exit;
        }

        // Necesitamos libros y lectores para los selectores del formulario
        $libroModel = new Libro($this->db);
        $lectorModel = new Lector($this->db);
        $libros = $libroModel->leer()->fetchAll(PDO::FETCH_ASSOC);
        $lectores = $lectorModel->leer()->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/prestamos/nuevo.php';
    }

    public function editar($id) {
        $this->prestamo->id = $id;

        if ($_POST) {
            $this->prestamo->fecha_devolucion = $_POST['fecha_devolucion'];

            // El modelo valida que fecha_devolucion >= fecha_prestamo
            if ($this->prestamo->actualizar()) {
                header("Location: index.php?action=prestamos&msg=updated");
            } else {
                header("Location: index.php?action=prestamos_editar&id=$id&msg=date_error");
            }
            exit;
        }

        $datos = $this->prestamo->leerUno();
        if ($datos) {
            require_once 'views/prestamos/editar.php';
        } else {
            header("Location: index.php?action=prestamos");
        }
    }

    public function eliminar($id) {
        $this->prestamo->id = $id;
        $this->prestamo->borrar();
        header("Location: index.php?action=prestamos&msg=deleted");
        exit;
    }
}
