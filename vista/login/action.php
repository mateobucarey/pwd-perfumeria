<?php
include_once("../estructura/cabeceraNoSegura.php");
$datos = darDatosSubmitted();
$resp = false;
//Array ( [accion] => login [usnombre] => malapi [uspass] => d41d8cd98f00b204e9800998ecf8427e )
//print_r($datos);
// echo "hola";
// print_r($datos);
if (isset($datos['accion'])){
    // print_r($datos);
// echo "primer if";
    if ($datos['accion']=="login"){
        // echo " segundo if";
        $objTrans = new Session();
        $resp = $objTrans->iniciar($datos['usnombre'],$datos['uspass']);
        // echo "aaaa";
        if($resp) {
            echo("<script>location.href = '../home/index.php';</script>");
        } else {
            $mensaje ="Error, vuelva a intentarlo";
            //echo("<script>location.href = './index.php?msg=".$mensaje."';</script>");
        }

    }

    
    if ($datos['accion']=="cerrar"){
        $objTrans = new Session();
        $resp = $objTrans->cerrar();
        if($resp) {
            $mensaje ="Vuelva... lo estaremos esperando...";
            echo("<script>location.href = './index.php?msg=".$mensaje."';</script>");
        }
    }
}
    echo $resp;

?>
