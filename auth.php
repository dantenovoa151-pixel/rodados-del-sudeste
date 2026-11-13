
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function esta_autenticado() {
    return isset($_SESSION["usuario_id"]);
}

function requerir_autenticacion() {
    if (!esta_autenticado()) {
        header("Location: login.php");
        exit;
    }
}

function requerir_rol($rol_esperado) {

    requerir_autenticacion();

    if ($_SESSION["usuario_rol"] !== $rol_esperado) {
        http_response_code(403);
        die("No tenes permisos para entrar a esta pagina.");
    }

}

function e($texto) {
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

?>
