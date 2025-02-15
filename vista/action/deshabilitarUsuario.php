<?php

include_once("../../configuracion.php");
$objAbmUsuario = new AbmUsuario();
$datos = data_submitted();

if(isset($datos['idusuario'])){
    $resp = $objAbmUsuario->borradoLogico($datos);
    if($resp){
        header('Location:../admin/gestionarUsuarios.php');
    }else{
        header('Location:../admin/gestionarUsuarios.php');
    }
    
}