<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRTransit - Rutas</title>

  <link rel="stylesheet" href="assets/css/general.css" />
  <link rel="stylesheet" href="assets/css/rutas.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

  <?php include 'general.php' ?>

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
          <div id="mapa" class="mapa-simulacion mt-3">
            <p class="text-center text-secondary pt-5">Mapa simulado de la ruta</p>
          </div>


          <div class="container mt-5">
            <h2 class="mb-3 text-center">Estimación de llegada</h2>

            <form method="GET" class="mb-4">
              <label for="ruta" class="form-label">Selecciona tu ruta:</label>
              <select name="ruta" id="ruta" class="form-select">
                <option value="">-- Selecciona --</option>
                <option value="500">Ruta 500 - Desamparados</option>
                <option value="520">Ruta 520 - Pavas</option>
                <option value="540">Ruta 540 - Escazú</option>
                <option value="550">Ruta 550 - Curridabat</option>
                <option value="570">Ruta 570 - Moravia</option>
                <option value="590">Ruta 590 - Montes de Oca</option>
              </select>
              <button type="submit" class="btn btn-primary mt-3">Calcular llegada</button>
            </form>

            <?php
              if (isset($_GET['ruta']) && $_GET['ruta'] !== "") {
                $ruta = $_GET['ruta'];
                $tiempo = "";
                $alerta = "";
                $tipo = "info";

                switch ($ruta) {
                  case "500":
                    $tiempo = "🕒 El bus llegará en 6 minutos.";
                    $alerta = "⚠️ Tráfico moderado en Desamparados.";
                    $tipo = "warning";
                    break;
                  case "520":
                    $tiempo = "🕒 El bus llegará en 10 minutos.";
                    $alerta = "⚠️ Obras en Pavas.";
                    $tipo = "danger";
                    break;
                  case "540":
                    $tiempo = "🕒 El bus llegará en 9 minutos.";
                    $alerta = "⚠️ Alta demanda en Escazú.";
                    $tipo = "warning";
                    break;
                  case "550":
                    $tiempo = "🕒 El bus llegará en 11 minutos.";
                    $alerta = "⚠️ Desvío temporal en Curridabat.";
                    $tipo = "danger";
                    break;
                  case "570":
                    $tiempo = "🕒 El bus llegará en 12 minutos.";
                    $alerta = "⚠️ Parada cerrada en Moravia.";
                    $tipo = "danger";
                    break;
                  case "590":
                    $tiempo = "🕒 El bus llegará en 13 minutos.";
                    $alerta = "⚠️ Congestión en Montes de Oca.";
                    $tipo = "warning";
                    break;
                }

                echo "<div class='alert alert-$tipo'><strong>$tiempo</strong><br>$alerta</div>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include 'footer.php' ?>

  <script src="assets/js/rutas.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>