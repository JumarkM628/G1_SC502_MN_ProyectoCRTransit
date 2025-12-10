<?php
require_once __DIR__ . '/../../config/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/app/views/registroL.php?login_error=' . urlencode('Acceso inválido'));
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    redirect('/app/views/registroL.php?login_error=' . urlencode('Debe completar todos los campos'));
}

try {
    $stmt = $pdo->prepare("SELECT idUsuario, password FROM usuario WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        redirect('/app/views/registroL.php?login_error=' . urlencode('Correo no encontrado'));
    }

    if (password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['idUsuario'];
        redirect('/app/views/General/general.php');
    } else {
        redirect('/app/views/registroL.php?login_error=' . urlencode('Contraseña incorrecta'));
    }

} catch (Exception $e) {
    redirect('/app/views/registroL.php?login_error=' . urlencode('Error en autenticación'));
}