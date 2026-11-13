<?php

require "config/conexion.php";
require "auth.php";

requerir_rol("admin");

$consulta = $conexion->prepare(
    "SELECT * FROM vehiculos ORDER BY id DESC"
);

$consulta->execute();

$vehiculos = $consulta->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de administración</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1>Panel de administración</h1>

    <a href="index.php">Volver al catálogo</a>

    <a href="vehiculo_form.php">Agregar vehículo</a>

    <h2>Vehículos cargados</h2>

    <?php foreach ($vehiculos as $vehiculo): ?>

        <div class="tarjeta">

            <h3><?= e($vehiculo["marca"]) ?> <?= e($vehiculo["modelo"]) ?></h3>

            <p>Año: <?= e($vehiculo["anio"]) ?></p>

            <p>Precio: $<?= e($vehiculo["precio"]) ?></p>

            <a href="vehiculo_form.php?id=<?= e($vehiculo["id"]) ?>">
                Modificar
            </a>

            <form action="vehiculo_eliminar.php" method="POST">

                <input type="hidden" name="id" value="<?= e($vehiculo["id"]) ?>">

                <button type="submit">Eliminar</button>

            </form>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>