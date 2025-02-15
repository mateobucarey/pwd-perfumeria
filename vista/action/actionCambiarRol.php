<?php
include_once("../../configuracion.php");
$datos = data_submitted();

$session = new Session();
$opcion = $datos['opcion'];
$session->modificarIdRol($opcion);

header("Location: ../inicio/home.php");
?>