<?php
// seed.php
require_once 'config/Database.php';

$database = new Database();
$db = $database->getConnection();

try {
    // 1. Limpiar tablas (Opcional, cuidado con las FK)
    $db->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $db->exec("TRUNCATE TABLE prestamos; TRUNCATE TABLE lectores; TRUNCATE TABLE libros;");
    $db->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // 2. Insertar Libros (con la propiedad 'autores' como texto)
    $libros = [
        ['Cien años de soledad', 'Gabriel García Márquez'],
        ['1984', 'George Orwell'],
        ['El Aleph', 'Jorge Luis Borges'],
        ['Rayuela', 'Julio Cortázar'],
        ['Don Quijote de la Mancha', 'Miguel de Cervantes']
    ];

    $stmtLibro = $db->prepare("INSERT INTO libros (titulo, autores) VALUES (?, ?)");
    foreach ($libros as $l) $stmtLibro->execute($l);
    echo "✅ Libros registrados.<br>";

    // 3. Insertar Lectores
    $lectores = [
        ['Juan Pérez', '12345678', 'juan.perez@email.com'],
        ['María García', '87654321', 'm.garcia@email.com'],
        ['Carlos Ruiz', '11223344', 'cruiz@email.com']
    ];

    $stmtLector = $db->prepare("INSERT INTO lectores (nombre, dni, email) VALUES (?, ?, ?)");
    foreach ($lectores as $lec) $stmtLector->execute($lec);
    echo "✅ Lectores registrados.<br>";

    // 4. Insertar Préstamos (Ejemplos de activos y devueltos)
    $prestamos = [
        // Libro 1 prestado a Lector 1 (Aún no devuelto)
        [1, 1, '2023-10-01', null],
        // Libro 2 prestado a Lector 2 (Ya devuelto)
        [2, 2, '2023-09-15', '2023-09-25']
    ];

    $stmtPre = $db->prepare("INSERT INTO prestamos (libro_id, lector_id, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)");
    foreach ($prestamos as $p) $stmtPre->execute($p);
    echo "✅ Préstamos de prueba registrados.<br>";

    echo "<br><strong>¡Datos de prueba listos!</strong> <a href='index.php'>Ir al inicio</a>";

} catch (PDOException $e) {
    echo "❌ Error al insertar datos: " . $e->getMessage();
}
