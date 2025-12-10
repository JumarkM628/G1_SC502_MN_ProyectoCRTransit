<?php
require_once __DIR__ . '/../../config/init.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirmPassword'] ?? '');

    if ($nombre === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = "Debe completar todos los campos.";
    }

    if ($password !== $confirm) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (empty($errors)) {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO usuario (nombre, email, password)
                VALUES (?, ?, ?)
            ");

            $stmt->execute([$nombre, $email, $passwordHash]);

            header("Location: ../registroL.php?registro=ok");
            exit;


        } catch (Exception $e) {
            $errors[] = "Error al registrar: " . $e->getMessage();
        }
    }
}