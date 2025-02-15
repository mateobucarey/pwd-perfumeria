<?php

$direccionMenu = $session->getDireccionMenu();
$direccionPadre = $session->getDireccionMenuPadre();
?>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-spray-can me-2" style="color: #5DADE2;"></i>
            <span style="font-family: 'Cursive', sans-serif; font-size: 1.5rem; color: #5DADE2;">Perfumes</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php
                if ($direccionMenu == "home.php") {
                    echo '<li class="nav-item active nav-underline">';
                    echo '  <a class="nav-link active" aria-current="page" href="#">Inicio</a>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '  <a class="nav-link" href="home.php">Inicio</a>';
                    echo '</li>';
                }

                if ($direccionMenu == "crearCuenta.php") {
                    echo '<li class="nav-item active nav-underline">';
                    echo '  <a class="nav-link active" aria-current="page" href="#">Crear Cuenta</a>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '  <a class="nav-link" href="crearCuenta.php">Crear Cuenta</a>';
                    echo '</li>';
                }

                if ($direccionMenu == "login.php") {
                    echo '<li class="nav-item active nav-underline">';
                    echo '  <a class="nav-link active" aria-current="page" href="#">Iniciar Sesión</a>';
                    echo '</li>';
                } else {
                    echo '<li class="nav-item">';
                    echo '  <a class="nav-link" href="login.php">Iniciar Sesión</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>