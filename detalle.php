<?php

require "config/conexion.php";
require "auth.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Vehiculo no valido.");
}

$consulta = $conexion->prepare(
    "SELECT * FROM vehiculos WHERE id = :id"
);

$consulta->execute([
    ":id" => $id
]);

$vehiculo = $consulta->fetch();

if (!$vehiculo) {
    die("El vehiculo no existe.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del vehículo</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1><?= e($vehiculo["marca"]) ?> <?= e($vehiculo["modelo"]) ?></h1>

    <img class="imagen-detalle" src="<?= e($vehiculo["imagen"]) ?>" alt="Vehículo">

    <p>Año: <?= e($vehiculo["anio"]) ?></p>

    <p>Precio: $<?= e($vehiculo["precio"]) ?></p>

    <p>Descripción: <?= e($vehiculo["descripcion"]) ?></p>

    <a href="index.php">Volver al catálogo</a>

</div>

</body>
</html>