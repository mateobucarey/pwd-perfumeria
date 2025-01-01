<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Página Crear Usuarios -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Usuario</h1>
        <form>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="userName" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="userPassword" placeholder="Contraseña">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Email del usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Roles</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="roleClient">
                    <label class="form-check-label" for="roleClient">Cliente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="roleWarehouse">
                    <label class="form-check-label" for="roleWarehouse">Depósito</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="roleAdmin">
                    <label class="form-check-label" for="roleAdmin">Administrador</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Crear Usuario</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>