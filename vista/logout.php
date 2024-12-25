<!-- logout.php -->
<?php
require_once 'Session.php';

$session = new Session();
$session->cerrar();

// Redirigir al formulario de login
header('Location: login.php');
exit;
