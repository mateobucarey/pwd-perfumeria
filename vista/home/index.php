<?php
//include_once("../estructura/cabeceraSegura.php");
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> -->
    <?php 
    $sesion = new Session();
    $objUsuario = $sesion->getUsuario();
    if($sesion->activa()){
        include_once("../estructura/cabeceraSegura.php");
    }else{
        include_once("../estructura/cabeceraNoSegura.php");
    }
    ?>
    <p>Aca iria el contenido de productos</p>
</body>
</html>