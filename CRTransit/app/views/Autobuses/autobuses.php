<?php
require_once __DIR__ . '/../../models/AutobusesFuncion.php';
$autobuses = obtenerAutobuses();

require_once __DIR__ . '/../../models/AlertasFuncion.php';

global $pdo;
$stmt = $pdo->query("SELECT idRuta, nombre FROM ruta");
$rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CRTransit - Autobuses</title>
  <link rel="stylesheet" href="../../public/css/general.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include __DIR__ . "/../layouts/header.php"; ?>

<div class="container my-5">
  <h2>Gestión de Autobuses</h2>

  <div class="row">
    <div class="col-md-5">
      <div class="card p-3 mb-4">
        <h5>Agregar autobús</h5>

        <form id="formAgregarBus" enctype="multipart/form-data">
          <div class="mb-2">
            <label class="form-label">Ruta</label>
            <select name="idRuta" id="idRuta" class="form-select" required>
              <option value="">--Selecciona ruta--</option>
              <?php foreach($rutas as $r): ?>
                <option value="<?= $r['idRuta'] ?>"><?= htmlspecialchars($r['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-2">
            <label class="form-label">Nombre conductor</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Placa</label>
            <input type="text" name="placa" class="form-control" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Foto (jpg/png)</label>
            <input type="file" name="img" accept=".jpg,.jpeg,.png" class="form-control">
          </div>

          <button class="btn btn-success" type="submit">Agregar</button>
        </form>
      </div>
    </div>

    <div class="col-md-7">
      <div class="card p-3">
        <h5>Autobuses registrados</h5>

        <table class="table table-striped" id="tabla-autobuses">
          <thead>
            <tr>
              <th>ID</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Placa</th>
              <th>Ruta</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($autobuses as $a): ?>
              <tr data-id="<?= $a['idBus'] ?>">
                <td><?= $a['idBus'] ?></td>
                <td>
                  <?php if (!empty($a['img'])): ?>
                    <img src="../../public/images/<?= htmlspecialchars($a['img']) ?>"
                         style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                  <?php else: ?>
                    <div style="width:48px;height:48px;border-radius:50%;background:#ddd;"></div>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($a['nombre']) ?></td>
                <td><?= htmlspecialchars($a['placa']) ?></td>
                <td><?= htmlspecialchars($a['nombreRuta'] ?? '') ?></td>
                <td>
                  <button class="btn btn-danger btn-sm btn-eliminar">Eliminar</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>

</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../public/js/autobus.js"></script>

</body>
</html>

