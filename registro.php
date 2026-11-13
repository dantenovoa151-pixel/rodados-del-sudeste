<?php

require "config/conexion.php";
require "auth.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["contraseñlña"] ?? "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mensaje = "El correo no es valido.";

    } elseif (strlen($password) < 4) {

        $mensaje = "La contraseña debe tener al menos 4";

    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {

            $consulta = $conexion->prepare(
                "INSERT INTO usuarios (email, password, rol)
                 VALUES (:email, :password, :rol)"
            );

            $consulta->execute([
                ":email" => $email,
                ":contraseña" => $hash,
                ":rol" => "usuario"
            ]);

            header("Location: login.php");
            exit;

        } catch (PDOException $error) {

            $mensaje = "No se pudo registrar. Puede que el correo ya exista.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Rodados del Sudeste</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1>Crear cuenta</h1>

    <form method="POST">

        <label>Correo electronico</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="password" required minlength="8">

        <button type="submit">Registrarse</button>

    </form>

    <p><?= e($mensaje) ?></p>

    <a href="login.php">Ya tengo una cuenta</a>

</div>

</body>
</html>