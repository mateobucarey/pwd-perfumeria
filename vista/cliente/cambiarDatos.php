<?php
//Este es un formulario para actualizar al usuario 
//redirige a actualizarLogin.php
 
include_once ('../../configuracion.php');
$datos['idusuario'] = 1;//data_submitted();//recibe el id de usuario desde el session, El numero es de prueba
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
    <table>
        <tr><td>NOMBRE:</td><td><?php echo $objUsuario->getUsNombre();?></td><td><a href="modificarNombre.php">CAMBIAR NOMBRE </a></td></tr>
        <tr><td>CONTRASEÑA:<td><?php echo "************";?></td></td>  <td><a href="modificarContrasenia.php">CAMBIAR CONTRASEÑA</a></td></tr>
        <tr><td>E-MAIL:</td><td><?php echo $objUsuario->getUsMail();?></td><td> <a href="modificarEmail.php">CAMBIAR E-MAIL</a> </td></tr>
    </table>
         <br>
       

</body>
</html>