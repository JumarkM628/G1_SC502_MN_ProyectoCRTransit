<?php
class DB {
    private $host = "localhost";
    private $port = 3307;
    private $user = "root";
    private $pass = "Parrapio2603*";
    private $dbname = "crtransit";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
            $this->port
        );

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}

class Alertas {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function agregar($ruta, $mensaje) {
        $stmt = $this->conexion->prepare("INSERT INTO alertas (ruta, mensaje) VALUES (?, ?)");
        $stmt->bind_param("ss", $ruta, $mensaje);
        return $stmt->execute();
    }

    public function borrar($id) {
        $stmt = $this->conexion->prepare("DELETE FROM alertas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function todas() {
        $resultado = $this->conexion->query("SELECT id, ruta, mensaje, fecha FROM alertas ORDER BY fecha DESC");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}

$db = new DB();
$conexion = $db->getConexion();
$alertasSrv = new Alertas($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_alerta'])) {
    $alertasSrv->agregar($_POST['ruta'], $_POST['mensaje']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar_alerta'])) {
    $alertasSrv->borrar($_POST['id']);
}

$alertas = $alertasSrv->todas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRTransit - Alertas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
          <option value="San José – Alajuela">San José – Alajuela</option>
          <option value="San José – Cartago">San José – Cartago</option>
          <option value="San José – Heredia">San José – Heredia</option>
          <option value="San José – Desamparados">San José – Desamparados</option>
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

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-light">Volver al inicio</a>
  </div>
</div>
</body>
</html>