<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRTransit - Rutas</title>

  <link rel="stylesheet" href="assets/css/general.css"/>
  <link rel="stylesheet" href="assets/css/rutas.css"/>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

  <?php include("general.php"); ?>

  <main class="container my-5">
    <h1 class="text-center fw-bold mb-4">Rutas Disponibles</h1>
    <p class="text-center text-muted mb-5">
      Selecciona una ruta para visualizar sus paradas y destino final.
    </p>

    <div class="row">
      <div class="col-md-4">
        <ul class="list-group" id="lista-rutas"></ul>
      </div>

      <div class="col-md-8">
        <div class="card-body">
          <h4 id="titulo-ruta" class="fw-bold">Selecciona una ruta</h4>
          <p id="descripcion-ruta" class="text-muted">
            Aquí se mostrará la información de la ruta seleccionada.
          </p>
          <div id="mapa" class="mapa-simulacion mt-3">
            <p class="text-center text-secondary pt-5">Mapa simulado de la ruta</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="assets/js/rutas.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>