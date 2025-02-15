<?php
//
include_once('../../configuracion.php');
$datos = data_submitted();
verEstructura($datos);
$passEncript = md5($datos['uspass']);
$datos['uspass'] = $passEncript;

$idUsuario = [];
$idUsuario['idusuario'] = $datos['idusuario'];
verEstructura($idUsuario);

$user = new AbmUsuario();
$exist = $user->buscar($idUsuario);
//verEstructura($exist);
if (count($exist) == 1) {
    if ($user->modificar($datos)) {
        //header('Location:../listarUsuario.php');
        echo "Contaseña Modificada";
    } else {
        echo "no se pudo modifcar al usario";
    }
} else {
    //echo "usuario NO modificado";
}
