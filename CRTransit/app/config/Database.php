<?php 


$db_host = 'localhost';
$db_name = 'crtransit';
$db_user = 'root';
$db_pass = 'Fidelitas.25';
$db_charset = 'utf8mb4';
$db_port = 3306;

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset;port=$db_port";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    exit("Error de conexión a la base de datos: ".$e->getMessage());
}

