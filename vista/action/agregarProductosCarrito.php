<?php 
include_once("../../configuracion.php");
$datos = data_submitted();//Recibe idcompraitem = 0(por el autoincrement), idproducto, idcompra y cicantidad
$session = new Session();
$datos['idusuario'] = $session->getIdUsuario(); 

$objCompraItem = new AbmCompraItem();
$agregar = $objCompraItem->agregarProductoCarrito($datos);

if($agregar){
   //header('Location: ../productos.php');
   $respuesta = array("resultado" => "exito", "mensaje" => "Agregado al carrito con éxito");
}else{
    $respuesta = array("resultado" => "error", "mensaje" => "Error, cantidad máxima posible de este producto ya alcanzada en el carrito");
}

echo json_encode($respuesta);
?>