<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <label for="email">Ingrese su correo </label>
        <input type="email" name="email" id="email">
        <input type="submit" value="enviar">
    </form>
</body>
</html> -->
<?php
// require 'pruebaphpmailer.php';
// require '../configuracion.php';


// // require_once 'util/funciones.php';
// // require 'enviarCorreo.php'; // Archivo con la función enviarCorreo()

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Obtén los datos usando la función darDatosSubmitted()
//     $datos = darDatosSubmitted();

//     // Recupera los datos necesarios
//     $destinatario = $datos['destinatario'] ?? null;
//     $nombreDestinatario = $datos['nombreDestinatario'] ?? null;
//     $asunto = $datos['asunto'] ?? null;
//     $mensajeHtml = $datos['mensajeHtml'] ?? null;
//     $mensajeTexto = $datos['mensajeTexto'] ?? null;

//     // Valida que todos los campos necesarios estén presentes
//     if ($destinatario && $nombreDestinatario && $asunto && $mensajeHtml && $mensajeTexto) {
//         $resultado = enviarCorreo($destinatario, $nombreDestinatario, $asunto, $mensajeHtml, $mensajeTexto);
//         echo $resultado;
//     } else {
//         echo 'Faltan datos obligatorios para enviar el correo.';
//     }
// } else {
//     echo 'Método no permitido.';
// }

