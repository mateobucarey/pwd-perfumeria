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
        <h1 class="text-center mb-4">Carrito de Compras</h1>
        <div class="row g-4">
            <!-- Ejemplo de tarjeta en el carrito -->
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
                                <p class="card-text">Cantidad: <input type="number" value="1" min="1" class="form-control w-25 d-inline"></p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <button class="btn btn-danger mb-2">Quitar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repetir estas tarjetas según los productos seleccionados -->
        </div>
        <div class="text-center mt-4">
            <a href="miscompras.html" class="btn btn-primary">Realizar Compra</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>