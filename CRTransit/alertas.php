<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRTransit - Alertas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/crtransit.css">
  <link rel="stylesheet" href="assets/css/general.css"/>
</head>
<body>

  <?php include("general.php"); ?>

  <div class="container mt-5">
    <h1 class="mb-4 text-center">Alertas activas por ruta</h1>

    <?php
    $alertas = [
      "500" => ["⚠️ Tráfico moderado en Desamparados", "warning"],
      "520" => ["⚠️ Obras en Pavas", "danger"],
      "540" => ["⚠️ Alta demanda en Escazú", "warning"],
      "550" => ["⚠️ Desvío temporal en Curridabat", "danger"],
      "570" => ["⚠️ Parada cerrada en Moravia", "danger"],
      "590" => ["⚠️ Congestión en Montes de Oca", "warning"]
    ];

    foreach ($alertas as $ruta => [$mensaje, $tipo]) {
      echo "<div class='alert alert-$tipo'><strong>Ruta $ruta:</strong> $mensaje</div>";
    }
    ?>

  </div>

  <?php include 'footer.php' ?>

</body>
</html>

<link rel="stylesheet" href="assets/css/general.css">