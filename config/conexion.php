
<?php

$host = "localhost";
$base = "RodadosDelSudeste";
$usuario = "root";
$password = "";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$base;charset=utf8mb4",
        $usuario,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $conexion->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

    $conexion->setAttribute(
        PDO::ATTR_EMULATE_PREPARES,
        false
    );

} catch (PDOException $error) {

    die("No se pudo conectar a la base de datos.");

}

?>
