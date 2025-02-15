<?php
include_once ("../../configuracion.php");
$session = new Session();
   
if ($session->activa()){
   $resp = $session->cerrar();
   $session->redireccion();
}

?>