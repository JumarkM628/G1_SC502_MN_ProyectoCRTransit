<?php
session_start();

require_once __DIR__ . '/database.php';

function redirect($url) {
    header("Location: $url");
    exit;
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        redirect('/app/views/auth/login.php');
    }
}

function current_user() {
    if (!isset($_SESSION['user_id'])) return null;

    global $pdo;
    $stmt = $pdo->prepare("SELECT idUsuario, nombre, email FROM usuario WHERE idUsuario = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}