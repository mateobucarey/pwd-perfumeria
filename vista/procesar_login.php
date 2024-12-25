<!-- procesar_login.php -->
<?php
require_once '../control/Session.php';
require_once '../control/AbmUsuario.php'; // Asegúrate de incluir todas las dependencias

$session = new Session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['usnombre'];
    $psw = $_POST['uspass'];

    if ($session->iniciar($nombreUsuario, $psw)) {
        // Redirigir al área privada si el inicio de sesión es exitoso
        header('Location: area_privada.php');
        exit;
    } else {
        // Redirigir de nuevo al login con un mensaje de error
        header('Location: login.php?error=1');
        exit;
    }
}
