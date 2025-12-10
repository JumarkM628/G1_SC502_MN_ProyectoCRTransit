<?php
session_start();
require_once __DIR__ . "/../../models/AlertasFuncion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRTransit - Rutas</title>

  <link rel="stylesheet" href="../../public/css/general.css" />
  <link rel="stylesheet" href="../../public/css/rutas.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

  <?php include __DIR__ . "/../layouts/header.php"; ?>

  <div class="container my-5">
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

          <div id="map"></div>

          <button id="btn-guardar-ruta" class="btn btn-success mt-3" style="display:none;">Guardar esta ruta</button>



          <div class="container mt-5">

            <h1 class="mb-4 text-center">Estimación de llegada</h1>

            <form method="GET" class="mb-4">
              <label class="form-label">Selecciona tu ruta:</label>
              <select name="ruta" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <option value="San José - Alajuela">San José - Alajuela</option>
                <option value="San José - Cartago">San José - Cartago</option>
                <option value="San José - Heredia">San José - Heredia</option>
                <option value="San José - Desamparados">San José - Desamparados</option>
              </select>
              <button class="btn btn-primary mt-3">Calcular llegada</button>
            </form>

            <?php

            if (isset($_GET["ruta"]) && $_GET["ruta"] !== "") {

              $ruta = $_GET["ruta"];
              $tiempo = "";

              switch ($ruta) {
                case "San José - Alajuela":
                  $tiempo = "El bus llegará en 8 minutos.";
                  break;
                case "San José - Cartago":
                  $tiempo = "El bus llegará en 12 minutos.";
                  break;
                case "San José - Heredia":
                  $tiempo = "El bus llegará en 10 minutos.";
                  break;
                case "San José - Desamparados":
                  $tiempo = "El bus llegará en 6 minutos.";
                  break;
              }

              $alerta = obtenerAlertaPorRuta($ruta);

              echo "<div class='alert alert-info'><strong>$tiempo</strong><br>";
              echo $alerta ? " {$alerta['mensaje']}" : "No hay alertas para esta ruta.";
              echo "</div>";
            }

            ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include __DIR__ . "/../layouts/footer.php"; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <script src="../../public/js/rutas.js"></script>

  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBksgxjZaSow4GA1Ht1l0W4eOdghW2486Y&libraries=places&callback=iniciarMap&loading=async"
    async defer>
    </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<link rel="stylesheet" href="../../public/css/general.css">