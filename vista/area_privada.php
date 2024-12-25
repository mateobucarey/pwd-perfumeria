<!-- area_privada.php -->
<?php
require_once 'Session.php';

$session = new Session();

if (!$session->activa()) {
    // Si no hay sesión activa, redirigir al login
    header('Location: login.php');
    exit;
}

$userInfo = $session->getUserInfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Privada</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($userInfo['usnombre']); ?>!</h2>
    <p>Roles: <?php echo implode(', ', $userInfo['roles']); ?></p>

    <?php if ($session->hasRole('admin')): ?>
        <p>Eres administrador. Tienes acceso a configuraciones avanzadas.</p>
    <?php endif; ?>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
