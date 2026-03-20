<?php
// controllers/LibroController.php

require_once 'config/Database.php';
require_once 'models/Libro.php';

class LibroController {
    private $db;
    private $libro;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->libro = new Libro($this->db);
    }

    /**
     * Muestra la lista de libros
     */
    public function index() {
        $stmt = $this->libro->leer();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/libros/index.php';
    }

    /**
     * Muestra el formulario de creación y procesa el guardado
     */
    public function crear() {
        if ($_POST) {
            $this->libro->titulo = $_POST['titulo'];
            $this->libro->autores = $_POST['autores'];

            if ($this->libro->crear()) {
                header("Location: index.php?action=libros&msg=success");
            } else {
                header("Location: index.php?action=libros_nuevo&msg=error");
            }
            exit;
        }
        require_once 'views/libros/nuevo.php';
    }

    /**
     * Muestra el formulario de edición y procesa la actualización
     */
    public function editar($id) {
        $this->libro->id = $id;
        
        if ($_POST) {
            $this->libro->titulo = $_POST['titulo'];
            $this->libro->autores = $_POST['autores'];
            
            if ($this->libro->actualizar()) {
                header("Location: index.php?action=libros&msg=updated");
            } else {
                header("Location: index.php?action=libros_editar&id=$id&msg=error");
            }
            exit;
        }

        if ($this->libro->leerUno()) {
            require_once 'views/libros/editar.php';
        } else {
            header("Location: index.php?action=libros");
        }
    }

    /**
     * Ejecuta el borrado respetando la restricción de préstamos
     */
    public function eliminar($id) {
        $this->libro->id = $id;
        
        if ($this->libro->borrar()) {
            header("Location: index.php?action=libros&msg=deleted");
        } else {
            // Regla de negocio: No se puede eliminar si tiene préstamos
            header("Location: index.php?action=libros&msg=restricted");
        }
        exit;
    }
}
