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
    <!-- Página Crear Productos -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Crear Producto</h1>
        <form>
            <div class="mb-3">
                <label for="productName" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="productName" placeholder="Nombre del producto">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Precio</label>
                <input type="number" class="form-control" id="productPrice" placeholder="Precio">
            </div>
            <div class="mb-3">
                <label for="productStock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="productStock" placeholder="Cantidad en stock">
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="productImage">
            </div>
            <button type="submit" class="btn btn-success w-100">Crear Producto</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>