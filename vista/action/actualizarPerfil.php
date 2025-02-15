<?php 
//
 include_once '../../configuracion.php';
 $datos = data_submitted();
 verEstructura($datos);
 
 $idUsuario=[];
 $idUsuario['idusuario']=$datos['idusuario'];
 verEstructura($idUsuario);
 
 $user = new AbmUsuario();
 $exist= $user->buscar($idUsuario);

 if(count($exist)==1){
    if($user->modificar($datos)){
       
        header('Location: ../opciones/miPerfil.php');
     }else{
        echo "no se pudo modifcar al usario";
     }
 }else{
    echo "usuario NO modificado";
 }

 
?>