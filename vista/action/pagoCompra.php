<?php
include_once ("../../configuracion.php");
//pasa el carrito al estado iniciada
$datos= data_submitted();//idusuario
verEstructura($datos);
$obj = new AbmCompraEstado();
$resp = $obj->pagarCompra($datos['idusuario']);

if($resp){
    header('Location: ../cliente/misCompras.php');

}else{
    header('Location: ../cliente/misCompras.php');
}

?>