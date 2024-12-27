<? 
include_once("../estructura/cabeceraNoSegura.php");
$datos= darDatosSubmitted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

</head>
<body> 
<?php 
      if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo $datos['msg'];
      }
        
     ?>
<form action="action.php" method="post" name="formulario" id="formulario">
    <input type="hidden" id="accion" name="accion" value="login">
     <label for="usnombre">Ingrese su nombre de usuario</label>
    <input type="text" name="usnombre" id="usnombre" required>
    <label for="uspass">Ingrese su contraseña</label>
    <input type="password" name="uspass" id="uspass" required>
    <input type="button" value="validar" onclick="formSubmit()">
</form>
<script>
    function formSubmit() {
    var uspass = document.getElementById("uspass").value;
    var passhash = CryptoJS.MD5(uspass).toString();
    document.getElementById("uspass").value = passhash;

    // Enviar el formulario directamente
    document.getElementById("formulario").submit();
}

</script>
   
</body>
</html>
<?php 

?>