<?php

include_once "../../configuracion.php";
$datos = data_submitted();

$usnombre = $datos['usnombre'];
$uspass = $datos['uspass'];

$param['usnombre'] = $usnombre;

$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar($param);

//ARMA LAS RESPUESTAS PARA LA SOLICITUD AJAX
if (count($colUsuarios) == 1){
    
    $param['uspass'] = $uspass;
    $colUsuarios = $objUsuario->buscar($param);

    if (count($colUsuarios) == 1){

        $session = new Session();
        $session->iniciar($usnombre, $uspass);

        if($session ->validar()){
            $respuesta = array("resultado" => "exito", "mensaje" => "Sesion iniciada con exito.");
        }else{
            if($colUsuarios[0]->getUsDeshabilitado() != '0000-00-00 00:00:00'){
                $respuesta = array("resultado" => "error", "mensaje" => "Su cuenta ha sido deshabilitada");
            }else{
                $respuesta = array("resultado" => "error", "mensaje" => "Esta cuenta aun no tiene roles asignados.
                \nEspere a que un admnistrador le asigne uno.");
            }
        }
    } else {
        $respuesta = array("resultado" => "error", "mensaje" => "El nombre de usuario y contraseña no coinciden.");
    }
} else {
    $respuesta = array("resultado" => "error", "mensaje" => "El nombre de usuario no existe.");
}
echo json_encode($respuesta);
?>