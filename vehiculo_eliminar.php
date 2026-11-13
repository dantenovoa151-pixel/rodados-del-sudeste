<?php

require "config/conexion.php";
require "auth.php";

requerir_rol("admin");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Solicitud no valida.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("ID no valido.");
}

$consulta = $conexion->prepare(
    "DELETE FROM vehiculos WHERE id = :id"
);

$consulta->execute([
    ":id" => $id
]);

header("Location: panel.php");
exit;

?>