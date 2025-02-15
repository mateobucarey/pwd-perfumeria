<?php
include_once('../../configuracion.php');
// Encapsulo los datos para crear usuario nuevo
$datos = data_submitted();
$usuario = new AbmUsuario();
$resp = $usuario->crearUsuarioAdmin($datos);
//verEstructura($datos);
if($resp){
    header('Location: ../admin/crearUsuarios.php');
}else{
    header('Location: ../admin/crearUsuarios.php');
}


?>