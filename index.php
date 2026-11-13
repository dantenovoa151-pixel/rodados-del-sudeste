
<?php

require "config/conexion.php";
require "auth.php";

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
    <title>Rodados del Sudeste</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1>Rodados del Sudeste</h1>

    <h2>Catálogo de vehículos</h2>

    <div class="acciones">

        <?php if (esta_autenticado()): ?>

            <p>Bienvenido: <?= e($_SESSION["usuario_email"]) ?></p>

            <a href="logout.php">Cerrar sesión</a>

            <?php if ($_SESSION["usuario_rol"] === "admin"): ?>
                <a href="panel.php">Panel de administración</a>
            <?php endif; ?>

        <?php else: ?>

            <a href="login.php">Iniciar sesión</a>
            <a href="registro.php">Registrarse</a>

        <?php endif; ?>

    </div>

    <?php if (count($vehiculos) === 0): ?>

        <p>No hay vehículos cargados actualmente.</p>

    <?php else: ?>

        <div class="catalogo">

            <?php foreach ($vehiculos as $vehiculo): ?>

                <div class="tarjeta">

                    <img
                        src="<?= e($vehiculo["imagen"]) ?>"
                        alt="Imagen del vehículo"
                    >

                    <h3>
                        <?= e($vehiculo["marca"]) ?>
                        <?= e($vehiculo["modelo"]) ?>
                    </h3>

                    <p>Año: <?= e($vehiculo["anio"]) ?></p>

                    <p>Precio: $<?= e($vehiculo["precio"]) ?></p>

                    <a href="detalle.php?id=<?= e($vehiculo["id"]) ?>">
                        Ver detalles
                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
