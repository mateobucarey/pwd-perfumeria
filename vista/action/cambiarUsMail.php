<?php
include_once "../../configuracion.php";
$session = new Session();
$datos = data_submitted();

$param['idusuario'] = $session->getIdUsuario();
$objAbmUsuario = new AbmUsuario();
$colUsuario = $objAbmUsuario->buscar($param);

$param['usmail'] = $datos['usmail'];

if (filter_var($param['usmail'], FILTER_VALIDATE_EMAIL)) {

    $param['usnombre'] = $colUsuario[0]->getUsNombre();
    $param['uspass'] = $colUsuario[0]->getUsPass();
    $param['usdeshabilitado'] = '0000-00-00 00:00:00';

    $resultado = $objAbmUsuario->modificar($param);

    if ($resultado){
      
        $respuesta = array("resultado" => "exito", "mensaje" => "Dirección de mail cambiada con éxito.");
        $session->modificarEmail($param['usmail']);
        
    } else {
        $respuesta = array("resultado" => "error", "mensaje" => "No pudo cambiarse la dirección de mail.");
    }

} else {
    $respuesta = array("resultado" => "error", "mensaje" => "No pudo cambiarse la dirección de mail.\nLa dirección no tiene un formato válido.");
}

echo json_encode($respuesta);
?>