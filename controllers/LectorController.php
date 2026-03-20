<?php
// controllers/LectorController.php

require_once 'config/Database.php';
require_once 'models/Lector.php';

class LectorController {
    private $db;
    private $lector;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->lector = new Lector($this->db);
    }

    /**
     * Lista todos los lectores registrados
     */
    public function index() {
        $stmt = $this->lector->leer();
        $lectores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/lectores/index.php';
    }

    /**
     * Gestiona el registro de un nuevo lector
     */
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->lector->nombre = $_POST['nombre'];
            $this->lector->dni    = $_POST['dni'];
            $this->lector->email  = $_POST['email'];

            if ($this->lector->crear()) {
                header("Location: index.php?action=lectores&msg=success");
            } else {
                header("Location: index.php?action=lectores_nuevo&msg=error");
            }
            exit;
        }
        require_once 'views/lectores/nuevo.php';
    }

    /**
     * Gestiona la edición de datos del lector
     */
    public function editar($id) {
        $this->lector->id = $id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->lector->nombre = $_POST['nombre'];
            $this->lector->dni    = $_POST['dni'];
            $this->lector->email  = $_POST['email'];

            if ($this->lector->actualizar()) {
                header("Location: index.php?action=lectores&msg=updated");
            } else {
                header("Location: index.php?action=lectores_editar&id=$id&msg=error");
            }
            exit;
        }

        if ($this->lector->leerUno()) {
            require_once 'views/lectores/editar.php';
        } else {
            header("Location: index.php?action=lectores");
        }
    }

    /**
     * Intenta eliminar un lector verificando la restricción de préstamos
     */
    public function eliminar($id) {
        $this->lector->id = $id;

        if ($this->lector->borrar()) {
            header("Location: index.php?action=lectores&msg=deleted");
        } else {
            // Se activa si el modelo Lector::borrar() retorna false por préstamos asociados
            header("Location: index.php?action=lectores&msg=restricted");
        }
        exit;
    }
}
