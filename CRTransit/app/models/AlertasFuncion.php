<?php
include __DIR__ . '/../config/Database.php';

function obtenerAlertas() {
    global $pdo;
    $query = $pdo->query("SELECT * FROM alertas ORDER BY id DESC");
    return $query->fetchAll();
}

function agregarAlerta($ruta, $mensaje) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO alertas (ruta, mensaje, fecha) VALUES (?, ?, NOW())");
    $stmt->execute([$ruta, $mensaje]);
}

function borrarAlerta($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM alertas WHERE id = ?");
    $stmt->execute([$id]);
}



function obtenerAlertaPorRuta($ruta) {
    global $pdo; 

    $sql = "SELECT mensaje, fecha FROM alertas WHERE ruta = ? ORDER BY fecha DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ruta]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

