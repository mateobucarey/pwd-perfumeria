<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-5">
        <h1 class="text-center mb-4">Gestionar Usuarios</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha Deshabilitación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de fila de usuario -->
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>juan@example.com</td>
                        <td>Cliente</td>
                        <td>-</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Actualizar</button>
                            <button class="btn btn-warning btn-sm">Asignar Roles</button>
                            <button class="btn btn-info btn-sm">Quitar Roles</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Repetir según usuarios registrados -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>