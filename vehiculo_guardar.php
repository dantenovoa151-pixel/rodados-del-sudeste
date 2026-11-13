<?php

require "config/conexion.php";
require "auth.php";

requerir_rol("admin");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Solicitud no valida.");
}

$id = $_POST["id"] ?? "";
$marca = trim($_POST["marca"] ?? "");
$modelo = trim($_POST["modelo"] ?? "");
$anio = $_POST["anio"] ?? "";
$precio = $_POST["precio"] ?? "";
$descripcion = trim($_POST["descripcion"] ?? "");
$imagen = trim($_POST["imagen"] ?? "");

if (
    $marca === "" 
    $modelo === "" 
    $descripcion === "" 
    $imagen === "" 
    !filter_var($anio, FILTER_VALIDATE_INT) 
    $anio < 1900 
    $anio > 2100 
    !is_numeric($precio) 
    $precio <= 0 
    strlen($marca) > 100 
    strlen($modelo) > 100 
    strlen($descripcion) > 2000 
    !filter_var($imagen, FILTER_VALIDATE_URL) 
    !in_array(parse_url($imagen, PHP_URL_SCHEME), ["http", "https"], true)
) {

    die("Revisa los datos ingresados.");

}

if ($id !== "") {

    if (!filter_var($id, FILTER_VALIDATE_INT)  $id < 1) {
        die("ID no valido.");
    }

    $consulta = $conexion->prepare(
        "UPDATE vehiculos
         SET marca = :marca,
             modelo = :modelo,
             anio = :anio,
             precio = :precio,
             descripcion = :descripcion,
             imagen = :imagen
         WHERE id = :id"
    );

    $consulta->execute([
        ":marca" => $marca,
        ":modelo" => $modelo,
        ":anio" => $anio,
        ":precio" => $precio,
        ":descripcion" => $descripcion,
        ":imagen" => $imagen,
        ":id" => $id
    ]);

} else {

    $consulta = $conexion->prepare(
        "INSERT INTO vehiculos
        (marca, modelo, anio, precio, descripcion, imagen)
        VALUES
        (:marca, :modelo, :anio, :precio, :descripcion, :imagen)"
    );

    $consulta->execute([
        ":marca" => $marca,
        ":modelo" => $modelo,
        ":anio" => $anio,
        ":precio" => $precio,
        ":descripcion" => $descripcion,
        ":imagen" => $imagen
    ]);

}

header("Location: panel.php");
exit;

?>