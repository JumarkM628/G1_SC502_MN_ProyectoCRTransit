<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRTransit - Estimación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/crtransit.css">
</head>
<body>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">Estimación de llegada</h1>

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

    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
    </div>
  </div>

</body>
</html>