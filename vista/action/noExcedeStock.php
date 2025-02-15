<?php 
include_once("../../configuracion.php");
$datos = data_submitted();

$objAbmProducto = new AbmProducto();
$resultado = $objAbmProducto->controlarStock($datos['cantidad'], $datos['idproducto']);

if($resultado){
   //header('Location: ../productos.php');
   $respuesta = array("resultado" => "exito", "mensaje" => "Agregado al carrito con éxito", "test" => $resultado);
}else{
    $respuesta = array("resultado" => "error", "mensaje" => "Error, no se pudo agregar al carrito", "test" => $resultado);
}

echo json_encode($respuesta);
?>