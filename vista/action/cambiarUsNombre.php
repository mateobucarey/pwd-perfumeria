<?php
include_once "../../configuracion.php";
$session = new Session();
$datos = data_submitted();

$param['idusuario'] = $session->getIdUsuario();
$objAbmUsuario = new AbmUsuario();
$colUsuario = $objAbmUsuario->buscar($param);

$param2['usnombre'] = $datos['usnombre'];

$resultadoNombreRepetido = $objAbmUsuario->buscar($param2);

if (count($resultadoNombreRepetido) == 0){

    $param['usnombre'] = $datos['usnombre'];
    $param['usmail'] = $colUsuario[0]->getUsMail();
    $param['uspass'] = $colUsuario[0]->getUsPass();
    $param['usdeshabilitado'] = '0000-00-00 00:00:00';
    
    $resultado = $objAbmUsuario->modificar($param);
    
    if ($resultado){
        $respuesta = array("resultado" => "exito", "mensaje" => "Nombre de usuario cambiado con éxito.");
        $session->modificarNombre($datos['usnombre']);
        
    } else {
        $respuesta = array("resultado" => "error", "mensaje" => "No pudo cambiarse el nombre de usuario.");
    }

} else {
    $respuesta = array("resultado" => "error", "mensaje" => "El nombre de usuario elegido ya se encuentra en uso.");
}

echo json_encode($respuesta);
?>