<?php
require_once __DIR__ . '/../../config/init.php';
require_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRTransit - Inicio</title>
  <link rel="stylesheet" href="../../public/css/general.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

  <?php include __DIR__ . "/../layouts/header.php";?>

  <div class="container my-5">
    <div class="text-center">
      <h1 class="fw-bold mb-3">Bienvenido a CRTransit</h1>
      <p class="text-muted">Tu pagina para monitorear rutas, horarios y notificaciones del transporte público en Costa
        Rica.</p>
      <a href="../../views/Rutas/rutas.php" class="btn btn-primary mt-3">Ver rutas disponibles</a>
    </div>
  </div>

  <?php include __DIR__ . "/../layouts/footer.php";?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>

<link rel="stylesheet" href="../../public/css/general.css">
