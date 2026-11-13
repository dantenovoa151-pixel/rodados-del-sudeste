<?php

require "config/conexion.php";
require "auth.php";

requerir_rol("admin");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$vehiculo = [
    "marca" => "",
    "modelo" => "",
    "anio" => "",
    "precio" => "",
    "descripcion" => "",
    "imagen" => ""
];

if ($id !== null && $id !== false) {

    if ($id < 1) {
        die("ID no valido.");
    }

    $consulta = $conexion->prepare(
        "SELECT * FROM vehiculos WHERE id = :id"
    );

    $consulta->execute([
        ":id" => $id
    ]);

    $resultado = $consulta->fetch();

    if (!$resultado) {
        die("Vehiculo no encontrado.");
    }

    $vehiculo = $resultado;

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de vehículos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1><?= $id ? "Modificar vehículo" : "Agregar vehículo" ?></h1>

    <form action="vehiculo_guardar.php" method="POST">

        <input type="hidden" name="id" value="<?= e($id) ?>">

        <label>Marca</label>
        <input type="text" name="marca" value="<?= e($vehiculo["marca"]) ?>" required maxlength="100">

        <label>Modelo</label>
        <input type="text" name="modelo" value="<?= e($vehiculo["modelo"]) ?>" required maxlength="100">

        <label>Año</label>
        <input type="number" name="anio" value="<?= e($vehiculo["anio"]) ?>" required min="1900" max="2100">

        <label>Precio</label>
        <input type="number" name="precio" value="<?= e($vehiculo["precio"]) ?>" required min="1" step="0.01">

        <label>Descripción</label>
        <textarea name="descripcion" required maxlength="2000"><?= e($vehiculo["descripcion"]) ?></textarea>

        <label>URL de imagen</label>
        <input type="url" name="imagen" value="<?= e($vehiculo["imagen"]) ?>" required>

        <button type="submit">Guardar vehículo</button>

    </form>

    <a href="panel.php">Volver al panel</a>

</div>

</body>
</html>