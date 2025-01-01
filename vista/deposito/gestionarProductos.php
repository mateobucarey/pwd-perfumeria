<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4">Gestionar Productos</h1>
        <div class="row g-4">
            <!-- Ejemplo de tarjeta de producto -->
            <div class="col-md-12">
                <div class="card">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2">
                            <img src="https://via.placeholder.com/150" class="img-fluid rounded-start" alt="Producto">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">Título del Producto</h5>
                                <p class="card-text">Precio: $100</p>
                                <p class="card-text">Stock: 10</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <a href="modificar_producto.html" class="btn btn-primary">Modificar Producto</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repetir tarjetas según productos -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>