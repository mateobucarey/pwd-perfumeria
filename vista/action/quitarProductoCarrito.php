<?php 
include_once("../../configuracion.php");
$datos = data_submitted();//Recibe idcompraitem 
//verEstructura($datos);
$objCompraItem = new AbmCompraItem();
$agregar = $objCompraItem->baja($datos);

if($agregar){
    header('Location:../cliente/carrito.php'); 
}else{
    header('Location:../cliente/carrito.php'); 

}
?>