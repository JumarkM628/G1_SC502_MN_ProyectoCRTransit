<?php
session_start();
require_once __DIR__ . '/../../models/AutobusesFuncion.php';
require_once __DIR__ . '/../../models/AlertasFuncion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $ruta = $_POST["ruta"];
    $nombre = $_POST["nombre"];
    $placa = $_POST["placa"];

    $nombreImagen = "";

    if (!empty($_FILES["img"]["name"])) {
        $directorio = __DIR__ . "/../../public/images/";
        $nombreImagen = time() . "_" . basename($_FILES["img"]["name"]);
        $rutaCompleta = $directorio . $nombreImagen;

        move_uploaded_file($_FILES["img"]["tmp_name"], $rutaCompleta);
    }

    agregarAutobus($ruta, $nombre, $placa, $nombreImagen);
    header("Location: autobuses.php?ok=1");
    exit;
}

if (isset($_GET["delete"])) {
    borrarAutobus($_GET["delete"]);
    header("Location: autobuses.php?del=1");
    exit;
}

$autobuses = obtenerAutobuses();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRTransit - Autobuses</title>
    <link rel="stylesheet" href="../../public/css/general.css">
    <link rel="stylesheet" href="../../public/css/autobuses.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

<?php include __DIR__ . "/../layouts/header.php"; ?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-4">Gestión de Autobuses</h1>

    <?php if (isset($_GET["ok"])): ?>
        <div class="alert alert-success">Autobús agregado correctamente.</div>
    <?php endif; ?>

    <?php if (isset($_GET["del"])): ?>
        <div class="alert alert-danger">Autobús eliminado.</div>
    <?php endif; ?>

    <div class="card p-4 mb-4">
        <h4>Registrar nuevo autobús</h4>
        <form method="POST" enctype="multipart/form-data">

            <label class="form-label">Ruta</label>
            <select name="ruta" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <option value="San José - Alajuela">San José - Alajuela</option>
                <option value="San José - Cartago">San José - Cartago</option>
                <option value="San José - Heredia">San José - Heredia</option>
                <option value="San José - Desamparados">San José - Desamparados</option>
            </select>

            <label class="form-label mt-3">Nombre del conductor</label>
            <input type="text" name="nombre" class="form-control" required>

            <label class="form-label mt-3">Placa</label>
            <input type="text" name="placa" class="form-control" required>

            <label class="form-label mt-3">Imagen</label>
            <input type="file" name="img" class="form-control" required>

            <button class="btn btn-primary mt-3">Guardar Bus</button>
        </form>
    </div>

    <h3 class="mt-4">Lista de Autobuses</h3>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Ruta</th>
                <th>Nombre Conductor</th>
                <th>Placa</th>
                <th>Imagen</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($autobuses as $bus): ?>
                <tr>
                    <td><?= $bus["ruta"] ?></td>
                    <td><?= $bus["nombre"] ?></td>
                    <td><?= $bus["placa"] ?></td>
                    <td>
                        <img src="../../public/images/<?= $bus["img"] ?>" 
                             width="80px" 
                             class="rounded">
                    </td>
                    <td>
                        <a href="autobuses.php?delete=<?= $bus["idBus"] ?>" 
                           class="btn btn-danger btn-sm">
                           Borrar
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>

</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>

</body>
</html>

