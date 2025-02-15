<?php
include_once("../../configuracion.php");

$datos = data_submitted(); 

$objEstado = new AbmCompraEstado();

$cambioRealizado = $objEstado->cancelarCompra($datos);
if ($cambioRealizado) {
    header('Location: ../cliente/misCompras.php');
} else {
    header('Location: ../cliente/misCompras.php');
}
