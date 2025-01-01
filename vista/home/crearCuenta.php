<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Cuenta</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="new-username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="new-username" placeholder="Ingresa tu nombre de usuario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico (Gmail)</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu Gmail">
                    </div>
                    <div class="mb-3">
                        <label for="new-password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="new-password" placeholder="Crea una contraseña">
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirm-password" placeholder="Confirma tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
