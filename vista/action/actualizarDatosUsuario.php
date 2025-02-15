<?php
//ACCIONES DE LA VISTA
include_once "../../configuracion.php";

session_start();
$param['usnombre'] = $session->getUsNombre();
$param['usmail'] = $session->getUsMail();
if( $param['usnombre'] != null && $param['usmail'] != null){
    $usnombre = $param['usnombre'];
    $usmail = $param['usmail'];
} else {
    $usnombre = "Null";
    $usmail = "Null";
}

//Este arreglo respuesta se puede armar segun como espere las respuestas
$respuesta = array("resultado" => "exito", "mensaje" => "consulta exitosa",
"usnombre" => $usnombre, "usmail" => $usmail);


//json es una especie de arreglo y la funcion json_encode($param) transforma los 
//arreglos php en formato json
//el echo imprime en pantalla el json y el javascript lee lo imprimido en pantalla
echo json_encode($respuesta);
?>