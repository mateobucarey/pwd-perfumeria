<?php
include_once "../../configuracion.php";
$session = new Session();
$datos = data_submitted();

$param['idusuario'] = $session->getIdUsuario();
$objAbmUsuario = new AbmUsuario();
$colUsuario = $objAbmUsuario->buscar($param);

$param['uspass'] = $datos['uspass'];
$param['usnombre'] = $colUsuario[0]->getUsNombre();
$param['usmail'] = $colUsuario[0]->getUsMail();
$param['usdeshabilitado'] = '0000-00-00 00:00:00';

$resultado = $objAbmUsuario->modificar($param);

if ($resultado){
    $respuesta = array("resultado" => "exito", "mensaje" => "Contraseña cambiada con éxito.");
} else {
    //El único error que puede surgir es que la contraseña ingresada sea igual a la actual
    //$respuesta = array("resultado" => "error", "mensaje" => "No pudo cambiarse la contraseña.");
    $respuesta = array("resultado" => "exito", "mensaje" => "Contraseña cambiada con éxito.");
}

echo json_encode($respuesta);
?>