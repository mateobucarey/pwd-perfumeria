<?php
include_once("../../configuracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$session = new Session();
if(!$session->activa()){
    header('location:../login/index.php');
}


$objSession = new Session();
$resp = $objSession->validar();
if($resp){
    // si es true, no te rediccionara
    echo "el usuario es valido";
}else{
    echo "el usuario no es valido";

?>
     <!-- <script>location.href = '../login/index.php'</script> -->
<?php 
}

?> 
<body>
<p>esta es la cabecera Segura</p>
