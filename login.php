
<?php

require_once __DIR__ . "/config/conexion.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $consulta = $conexion->prepare(
        "SELECT * FROM usuarios WHERE email = :email"
    );

    $consulta->execute([
        ":email" => $email
    ]);

    $usuario = $consulta->fetch();

    if ($usuario && password_verify($password, $usuario["password"])) {

        session_regenerate_id(true);

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_email"] = $usuario["email"];
        $_SESSION["usuario_rol"] = $usuario["rol"];

        header("Location: index.php");
        exit;

    } else {

        $mensaje = "Correo o contraseña incorrectos.";

    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="contenedor">

    <h1>Iniciar sesión</h1>

    <form method="POST">

        <label>Correo electrónico</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">Ingresar</button>

    </form>

    <p><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>

    <a href="registro.php">Crear una cuenta</a>

</div>

</body>
</html>
