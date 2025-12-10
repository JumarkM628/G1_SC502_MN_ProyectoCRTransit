<?php

require_once __DIR__ . "/../config/Database.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['ok' => false, 'mensaje' => 'Método no permitido']);
    exit;
}

$idRuta = isset($_POST['idRuta']) ? intval($_POST['idRuta']) : 0;
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$placa = isset($_POST['placa']) ? trim($_POST['placa']) : '';

if (!$idRuta || !$nombre || !$placa) {
    echo json_encode(['ok' => false, 'mensaje' => 'Datos incompletos']);
    exit;
}

$uploadDir = __DIR__ . '../../public/images/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$imgName = '';
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['img']['tmp_name'];
    $origName = basename($_FILES['img']['name']);
    $ext = pathinfo($origName, PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png'];

    if (!in_array(strtolower($ext), $allowed)) {
        echo json_encode(['ok' => false, 'mensaje' => 'Formato de imagen no permitido']);
        exit;
    }

    // Generar nombre único
    $imgName = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '-', $origName);
    $dest = $uploadDir . $imgName;

    if (!move_uploaded_file($tmp, $dest)) {
        echo json_encode(['ok' => false, 'mensaje' => 'Error subiendo la imagen']);
        exit;
    }
}

try {
    $stmt = $pdo->prepare("INSERT INTO autobuses (idRuta, nombre, placa, img) VALUES (?, ?, ?, ?)");
    $stmt->execute([$idRuta, $nombre, $placa, $imgName]);

    echo json_encode(['ok' => true, 'mensaje' => 'Autobús agregado correctamente']);
} catch (PDOException $e) {
    echo json_encode(['ok' => false, 'mensaje' => 'Error: ' . $e->getMessage()]);
}
