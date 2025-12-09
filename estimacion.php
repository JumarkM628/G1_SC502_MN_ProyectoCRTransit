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
        <option value="alajuela">San José – Alajuela</option>
        <option value="cartago">San José – Cartago</option>
        <option value="heredia">San José – Heredia</option>
        <option value="desamparados">San José – Desamparados</option>
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
        case "alajuela":
          $tiempo = "🕒 El bus llegará en 8 minutos.";
          $alerta = "⚠️ Tráfico moderado en la autopista General Cañas.";
          $tipo = "warning";
          break;
        case "cartago":
          $tiempo = "🕒 El bus llegará en 12 minutos.";
          $alerta = "⚠️ Congestión en la ruta hacia Cartago.";
          $tipo = "danger";
          break;
        case "heredia":
          $tiempo = "🕒 El bus llegará en 10 minutos.";
          $alerta = "⚠️ Alta demanda en Heredia centro.";
          $tipo = "warning";
          break;
        case "desamparados":
          $tiempo = "🕒 El bus llegará en 6 minutos.";
          $alerta = "⚠️ Tráfico pesado en Desamparados.";
          $tipo = "danger";
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