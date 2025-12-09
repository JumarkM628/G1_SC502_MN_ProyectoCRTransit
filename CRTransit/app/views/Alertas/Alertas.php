<?php
require_once __DIR__ . "/../../models/AlertasFuncion.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (isset($_POST["nueva_alerta"])) {
    agregarAlerta($_POST["ruta"], $_POST["mensaje"]);
  }

  if (isset($_POST["borrar_alerta"])) {
    borrarAlerta($_POST["id"]);
  }
}

$alertas = obtenerAlertas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRTransit - Alertas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <?php include __DIR__ . "/../layouts/header.php"; ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">Alertas activas</h1>

    <?php if ($alertas): ?>
      <?php foreach ($alertas as $alerta): ?>
        <div class="alert alert-warning">
          <strong><?= $alerta['ruta'] ?>:</strong> <?= $alerta['mensaje'] ?>
          <small class="text-muted">(<?= $alerta['fecha'] ?>)</small>
          <form method="POST" class="mt-2">
            <input type="hidden" name="id" value="<?= $alerta['id'] ?>">
            <button type="submit" name="borrar_alerta" class="btn btn-danger btn-sm">Borrar</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info">No hay alertas registradas.</div>
    <?php endif; ?>

    <form method="POST" class="mt-4">
      <div class="row g-2">
        <div class="col-md-4">
          <select name="ruta" class="form-select" required>
            <option value="">-- Selecciona --</option>
            <option value="San José - Alajuela">San José - Alajuela</option>
            <option value="San José - Cartago">San José - Cartago</option>
            <option value="San José - Heredia">San José - Heredia</option>
            <option value="San José - Desamparados">San José - Desamparados</option>
          </select>
        </div>
        <div class="col-md-6">
          <input type="text" name="mensaje" class="form-control" placeholder="Ej: Tráfico moderado" required>
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" name="nueva_alerta" class="btn btn-primary">Agregar</button>
        </div>
      </div>
    </form>


  </div>

  <?php include __DIR__ . "/../layouts/footer.php"; ?>
</body>

</html>