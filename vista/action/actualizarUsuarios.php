<?php 
include_once('../../configuracion.php');
$datos = data_submitted();
//verEstructura($datos);
$objUsuario = new AbmUsuario();

//$existe = $objUsuario->existen($datos);
//if ($existe == false){

    $exito = $objUsuario->modificar($datos);
    if($exito){
        header('Location:../admin/gestionarUsuarios.php');
    }else{
        //echo "Algo fallo";
        header('Location:../admin/gestionarUsuarios.php');
    }
//}else{
    //echo "existe usuario";
//}

?>