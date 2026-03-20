<?php
// index.php - Enrutador Principal (Front Controller)

// Configuración de errores para desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Carga de controladores
require_once 'controllers/LibroController.php';
require_once 'controllers/LectorController.php';
require_once 'controllers/PrestamoController.php';

// Capturar la acción de la URL (por defecto es 'home')
$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

// Iniciar almacenamiento en búfer para capturar la vista
ob_start();

try {
    switch ($action) {
        // --- CRUD LIBROS ---
        case 'libros':
            (new LibroController())->index();
            break;
        case 'libros_nuevo':
            (new LibroController())->crear();
            break;
        case 'libros_editar':
            (new LibroController())->editar($id);
            break;
        case 'libros_eliminar':
            (new LibroController())->eliminar($id);
            break;

        // --- CRUD LECTORES ---
        case 'lectores':
            (new LectorController())->index();
            break;
        case 'lectores_nuevo':
            (new LectorController())->crear();
            break;
        case 'lectores_editar':
            (new LectorController())->editar($id);
            break;
        case 'lectores_eliminar':
            (new LectorController())->eliminar($id);
            break;

        // --- CRUD PRÉSTAMOS ---
        case 'prestamos':
            (new PrestamoController())->index();
            break;
        case 'prestamos_nuevo':
            (new PrestamoController())->crear();
            break;
        case 'prestamos_editar':
            (new PrestamoController())->editar($id);
            break;
        case 'prestamos_eliminar':
            (new PrestamoController())->eliminar($id);
            break;

        // --- HOME PAGE ---
        case 'home':
        default:
            require_once 'views/home.php';
            break;
    }
} catch (Exception $e) {
    echo "<div class='p-4 bg-red-100 text-red-700'>Error en el sistema: " . $e->getMessage() . "</div>";
}

// Guardar el contenido generado en una variable y limpiar el búfer
$content = ob_get_clean();

// Cargar el Layout principal e inyectar el contenido
require_once 'views/layout.php';
