<?php
//Este es un formulario para actualizar al usuario 
//redirige a actualizarLogin.php
 
include_once ('../../configuracion.php');
$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$listaUsuario = $abmUsuario->buscar($datos);
$objUsuario = $listaUsuario[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../action/cambioNombre.php" method="post">
        ID: <input type="text" id="idusuario" name="idusuario" value='<?php echo $objUsuario->getIdUsuario() ?>' readonly > <br>
        NOMBRE: <input type="text" id="usnombre" name="usnombre" value='<?php echo $objUsuario->getUsNombre() ?>'> <br>
        CONTRASEÑA: <input type="text" name="uspass" id="uspass" value='<?php echo $objUsuario->getUsPass() ?>' readonly > <br> 
        E-MAIL: <input type="text" id="usmail" name="usmail" value='<?php echo $objUsuario->getUsMail() ?>' readonly > <br>
        HABILITAR: <input type="text" id="usdeshabilitado" name="usdeshabilitado" value='<?php echo $objUsuario->getUsDeshabilitado() ?>' readonly > <br>
        <input type="submit"  value="Actualizar"> 
    </form>
</body>
</html>