<?php 
include_once("../../configuracion.php");
$datos= darDatosSubmitted();
echo $datos['username'];

echo $datos['password'];