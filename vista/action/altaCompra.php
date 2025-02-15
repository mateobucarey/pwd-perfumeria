<?php
include_once ("../../configuracion.php");
//colocar en menu dinamico, no va un altaCompra.php
//tiene que recibir el idusario y cofecha(o seteamos la fecha en 0000-00-00 00:00:00 ?)
$datos = data_submitted();
verEstructura($datos);
$datos['cofecha'] =   null;
verEstructura($datos);
$objCompra = new AbmCompra();
 $exito = $objCompra->alta($datos);
if($exito){
    echo "Compra Creada";
}else{
    echo "Algo fallo";
}

?>