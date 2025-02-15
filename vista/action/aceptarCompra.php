<?php
include_once ("../../configuracion.php");
//pasa el carrito al estado iniciada
$datos = data_submitted();//idCompra
//verEstructura($datos);
$objEstado = new AbmCompraEstado();
$compraAceptada = $objEstado->aceptarCompra($datos);
if($compraAceptada){
    header("Location: ../deposito/gestionarCompras.php");
}else{
    header("Location: ../deposito/gestionarCompras.php");
}

?>