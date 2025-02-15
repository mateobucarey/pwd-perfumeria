<?php
include_once ("../../configuracion.php");
//colocar en menu dinamico, no va un altaCompra.php
//tiene que recibir el idusario y cofecha(o seteamos la fecha en 0000-00-00 00:00:00 ?)
$datos = data_submitted();
//verEstructura($datos);
$objProducto = new AbmProducto();
 $exito = $objProducto->modificar($datos);
if($exito){
    header("Location: ../deposito/gestionarProductos.php");
}else{
    header("Location: ../deposito/gestionarProductos.php");
}

?>