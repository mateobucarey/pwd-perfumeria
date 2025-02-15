<?php
include_once("../../configuracion.php");

$session = new Session();

if ($session->validar()) {
    $rol = $session->getIdRol();
} else {
    $rol = null;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $titulo ?></title>

    <!-- link a librería de bootstrap -->
    <!--<script src="../../Util/librerias/bootstrap/bootstrap.bundle.min.js"></script>-->
    <link rel="stylesheet" href="../librerias/bootstrap/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Favicon -->
    <link  rel= "apple-touch-icon"  tamaños= "57x57"  href= "../assets/img/favicon/apple-icon-57x57.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "60x60"  href= "../assets/img/favicon/apple-icon-60x60.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "72x72"  href= "../assets/img/favicon/apple-icon-72x72.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "76x76"  href= "../assets/img/favicon/apple-icon-76x76.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "114x114"  href= "../assets/img/favicon/apple-icon-114x114.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "120x120"  href= "../assets/img/favicon/apple-icon-120x120.png" > 
    <link  rel= "apple-touch-icon"  tamaños = "144x144"  href = "../assets/img/favicon/apple-icon-144x144.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "152x152"  href= "../assets/img/favicon/apple-icon-152x152.png" > 
    <link  rel= "apple-touch-icon"  tamaños= "180x180"  href= "../assets/img/favicon/apple-icon-180x180.png" > 
    <link  rel= "icon"  tipo= "image/png"  tamaños= "192x192"   href= "../assets/img/favicon/android-icon-192x192.png" > 
    <link  rel= "icon"  tipo= "image/png"  tamaños= "32x32"  href= "../assets/img/favicon/favicon-32x32.png" > 
    <link  rel= "icono"  tipo= "imagen/png"  tamaños= "96x96"  href= "../assets/img/favicon/favicon-96x96.png" > 
    <link  rel= "icono"  tipo= "imagen/png"  tamaños= "16x16"  href= "../assets/img/favicon/favicon-16x16.png" > 
    <link  rel= "manifiesto"  href= "../assets/img/favicon/manifiesto.json" > 
    <meta  nombre= "msapplication-TileColor"  contenido= "#ffffff" > 
    <meta  nombre= "msapplication-TileImage"  contenido= "../assets/img/favicon/ms-icon-144x144.png" > 
    <meta  nombre= "theme-color"  contenido= "#ffffff" >
        
    <!-- link a librería de jquery -->
    <script src="../librerias/jquery/jquery-3.7.1.min.js"></script>
    <script src="../librerias/jquery/jquery.validate.min.js"></script>
    <script src="../librerias/jquery/messages_es_PE.js"></script>

    <!-- link a librería JS para encriptar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <!-- link a css propio -->
    <link rel="stylesheet" href="../css/estilos.css">

    <!-- link a iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body class="bg-light">
