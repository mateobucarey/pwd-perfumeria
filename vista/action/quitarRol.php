<?php
//Este es un formulario para actualizar al usuario 
//redirige a actualizarLogin.php
include_once('../../configuracion.php');
$datos = data_submitted();//estoy recibiendo el id del rol y el usuario
//verEstructura($datos);
$objUsuarioRol = new AbmUsuarioRol();
$exito = $objUsuarioRol->baja($datos);
if($exito){
    header('Location:../admin/gestionarUsuarios.php');
}else{
    header('Location:../admin/gestionarUsuarios.php');
}

?>