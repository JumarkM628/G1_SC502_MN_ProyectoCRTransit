<?php
header("Content-Type: application/json");

require_once __DIR__ . "/../config/Database.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["mensaje" => "Datos no válidos"]);
    exit;
}

$nombre = $input["nombre"];
$origen = $input["origen"];
$destino = $input["destino"];
$duracion = intval($input["duracion"]);

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=$db_charset;port=$db_port",
        $db_user,
        $db_pass
    );

    $stmt = $pdo->prepare("INSERT INTO ruta (nombre, origen, destino, duracion) VALUES (?, ?, ?, ?)");

    $stmt->execute([$nombre,$origen,$destino, $duracion]);

    echo json_encode(["mensaje" => "Ruta guardada con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["mensaje" => "Error: " . $e->getMessage()]);
}
