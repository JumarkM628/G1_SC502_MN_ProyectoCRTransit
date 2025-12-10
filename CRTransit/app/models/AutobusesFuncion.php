<?php
// app/models/AutobusesFuncion.php
require_once __DIR__ . '/../config/Database.php'; // $pdo debe quedar disponible

// Devuelve todos los autobuses (con info de la ruta)
function obtenerAutobuses() {
    global $pdo;
    $stmt = $pdo->query("SELECT a.*, r.nombre as nombreRuta, r.origen, r.destino FROM autobuses a LEFT JOIN ruta r ON a.idRuta = r.idRuta ORDER BY a.idBus DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener autobuses por idRuta
function obtenerAutobusesPorRutaId($idRuta) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM autobuses WHERE idRuta = ?");
    $stmt->execute([$idRuta]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener el primer autobus asociado a la ruta (útil para mostrar en ruta.php)
function obtenerPrimerAutobusPorRutaId($idRuta) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM autobuses WHERE idRuta = ? LIMIT 1");
    $stmt->execute([$idRuta]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener ruta por nombre (devuelve fila de ruta)
function obtenerRutaPorNombre($nombreRuta) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM ruta WHERE nombre = ? LIMIT 1");
    $stmt->execute([$nombreRuta]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Agregar autobús
function agregarAutobus($idRuta, $nombre, $placa, $img) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO autobuses (idRuta, nombre, placa, img) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$idRuta, $nombre, $placa, $img]);
}

// Eliminar autobús (devuelve true/false)
function eliminarAutobus($idBus) {
    global $pdo;
    // obtener img para borrar archivo si existe
    $stmt = $pdo->prepare("SELECT img FROM autobuses WHERE idBus = ?");
    $stmt->execute([$idBus]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    $deleted = false;
    if ($fila) {
        $stmt2 = $pdo->prepare("DELETE FROM autobuses WHERE idBus = ?");
        $deleted = $stmt2->execute([$idBus]);

        if ($deleted && !empty($fila['img'])) {
            // intentar borrar el archivo (ruta relativa desde controllers/ o desde donde ejecutes)
            $path = __DIR__ . "/../../public/images/" . $fila['img'];
            if (file_exists($path)) @unlink($path);
        }
    }

    return $deleted;
}
