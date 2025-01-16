<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Envío de Correo</title>
</head>
<body>
    <h1>Enviar Correo</h1>
    <form action="pruebaphpmailer.php" method="POST">
        <label for="destinatario">Correo del Destinatario:</label>
        <input type="email" id="destinatario" name="destinatario" required>
        <br><br>
        
        <label for="nombreDestinatario">Nombre del Destinatario:</label>
        <input type="text" id="nombreDestinatario" name="nombreDestinatario" required>
        <br><br>
        
        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" required>
        <br><br>
        
        <label for="mensajeHtml">Mensaje (HTML):</label>
        <textarea id="mensajeHtml" name="mensajeHtml" rows="5" cols="40" required></textarea>
        <br><br>
        
        <label for="mensajeTexto">Mensaje (Texto Plano):</label>
        <textarea id="mensajeTexto" name="mensajeTexto" rows="5" cols="40" required></textarea>
        <br><br>
        
        <button type="submit">Enviar Correo</button>
    </form>
</body>
</html>
