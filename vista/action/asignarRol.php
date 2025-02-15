<?php
include_once('../../configuracion.php');

$datos = data_submitted();

verEstructura($datos);
$objUsuarioRol = new AbmUsuarioRol();
$exito = $objUsuarioRol->alta($datos);
if($exito){
    header('Location:../admin/gestionarUsuarios.php');
}else{
    header('Location:../admin/gestionarUsuarios.php');
}

?>