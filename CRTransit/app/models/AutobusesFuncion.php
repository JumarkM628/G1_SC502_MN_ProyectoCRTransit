<?php
include __DIR__ . '/../config/Database.php';

function obtenerAutobuses() {
    global $pdo;
    $query = $pdo->query("SELECT * FROM autobuses ORDER BY idBus DESC");
    return $query->fetchAll();
}

function agregarAutobus($ruta, $nombre, $placa, $imagen) {
    global $pdo;

    $sql = "INSERT INTO autobuses (ruta, nombre, placa, img, fecha) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ruta, $nombre, $placa, $imagen]);
}

function borrarAutobus($idBus) {
    global $pdo;

    
    $stmt = $pdo->prepare("SELECT img FROM autobuses WHERE idBus = ?");
    $stmt->execute([$idBus]);
    $bus = $stmt->fetch();

    if ($bus && !empty($bus["img"])) {
        $rutaImg = __DIR__ . "/../../public/images/" . $bus["img"];
        if (file_exists($rutaImg)) {
            unlink($rutaImg);
        }
    }

    
    $stmt = $pdo->prepare("DELETE FROM autobuses WHERE idBus = ?");
    $stmt->execute([$idBus]);
}

function obtenerAutobusPorRuta($ruta) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM autobuses WHERE ruta = ? ORDER BY fecha DESC LIMIT 1");
    $stmt->execute([$ruta]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}





