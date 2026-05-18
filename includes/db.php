<?php
// ============================================================
// includes/db.php
// Conexión a la base de datos usando PDO
// ============================================================

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'kinder');
define('DB_USER', 'root');       // Cambia esto en AwardSpace
define('DB_PASS', '');           // Cambia esto en AwardSpace
define('DB_CHARSET', 'utf8');

try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // En producción nunca mostrar el error real
    die(json_encode(['error' => 'No se pudo conectar a la base de datos.']));
}
