<?php
// config/Database.php

class Database {
    private $db_host;
    private $db_port;
    private $db_name;
    private $username;
    private $password; 
    public $conn;

    public function __construct() {
       
        $this->db_host = getenv('DB_HOST') ?: '127.0.0.1';
        $this->db_port = getenv('DB_PORT') ?: '3306';
        $this->db_name = getenv('DB_NAME') ?: 'biblioteca_db';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASS') ?: 'root_password';
    }

    /**
     * Establece la conexión y asegura la existencia de la estructura de datos.
     */
    public function getConnection() {
        $this->conn = null;
        $max_retries = 12;
        $delay_sec   = 5;

        for ($attempts = 1; $attempts <= $max_retries; $attempts++) {
            try {
                // 1. Conexión inicial al servicio "db"
                $this->conn = new PDO(
                    "mysql:host={$this->db_host};port={$this->db_port};charset=utf8mb4", 
                    $this->username, 
                    $this->password,                  
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );

                // 2. Crear base de datos si no existe
                $this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $this->conn->exec("USE " . $this->db_name);

                // 3. Ejecutar creación de tablas
                $this->createTables();

                return $this->conn;
            } catch(PDOException $exception) {
                error_log("Intento {$attempts}/{$max_retries}: MySQL aún no listo ({$e->getMessage()})");
                sleep($delay_sec);
            }
        }
                    
        die("Error: No se pudo conectar a la base de datos tras varios intentos.");
    }

    /**
     * Define la estructura de tablas respetando las reglas de negocio.
     */
    private function createTables() {
        $queries = [
            // Tabla Libros: Incluye la propiedad "autores" de tipo texto
            "CREATE TABLE IF NOT EXISTS libros (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(255) NOT NULL,
                autores TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB;",

            // Tabla Lectores
            "CREATE TABLE IF NOT EXISTS lectores (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                dni VARCHAR(20) UNIQUE NOT NULL,
                email VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB;",

            // Tabla Préstamos: Sin fecha de devolución obligatoria al inicio
            "CREATE TABLE IF NOT EXISTS prestamos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                libro_id INT NOT NULL,
                lector_id INT NOT NULL,
                fecha_prestamo DATE NOT NULL,
                fecha_devolucion DATE NULL,
                FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE RESTRICT,
                FOREIGN KEY (lector_id) REFERENCES lectores(id) ON DELETE RESTRICT
            ) ENGINE=InnoDB;"
        ];

        foreach ($queries as $sql) {
            $this->conn->exec($sql);
        }
    }
}
