<?php

require_once __DIR__ . "/../config/Database.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$idBus = isset($input['idBus']) ? intval($input['idBus']) : 0;

if (!$idBus) {
    echo json_encode(['ok' => false, 'mensaje' => 'ID inválido']);
    exit;
}

// obtener img
$stmt = $pdo->prepare("SELECT img FROM autobuses WHERE idBus = ?");
$stmt->execute([$idBus]);
$fila = $stmt->fetch(PDO::FETCH_ASSOC);

try {
    $stmt2 = $pdo->prepare("DELETE FROM autobuses WHERE idBus = ?");
    $stmt2->execute([$idBus]);

    if ($fila && !empty($fila['img'])) {
        $path = __DIR__ . "../../public/images/" . $fila['img'];
        if (file_exists($path)) @unlink($path);
    }

    echo json_encode(['ok' => true, 'mensaje' => 'Autobús eliminado']);
} catch (PDOException $e) {
    echo json_encode(['ok' => false, 'mensaje' => 'Error: '.$e->getMessage()]);
}
