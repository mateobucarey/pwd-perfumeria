<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <form method="POST" action="procesar_login.php">
        <label for="usnombre">Usuario:</label>
        <input type="text" id="usnombre" name="usnombre" required><br><br>
        
        <label for="uspass">Contraseña:</label>
        <input type="password" id="uspass" name="uspass" required><br><br>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
