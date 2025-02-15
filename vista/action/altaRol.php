<?php
//Este es un formulario para actualizar al usuario 
//redirige a getionarRoles.php
include_once('../../configuracion.php');
$datos = data_submitted();//estoy recibiendo el id del rol y el usuario
//verEstructura($datos);

$objRol = new AbmRol();
$exito = $objRol->alta($datos);
if($exito){
    header('Location:../admin/gestionarRoles.php');
}else{
    header('Location:../admin/gestionarRoles.php');
}

?>