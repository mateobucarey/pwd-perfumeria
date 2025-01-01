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
        <h1 class="text-center mb-4">Modificar Producto</h1>
        <form>
            <div class="mb-3">
                <label for="modifyProductName" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="modifyProductName" placeholder="Nombre del producto">
            </div>
            <div class="mb-3">
                <label for="modifyProductPrice" class="form-label">Precio</label>
                <input type="number" class="form-control" id="modifyProductPrice" placeholder="Precio">
            </div>
            <div class="mb-3">
                <label for="modifyProductStock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="modifyProductStock" placeholder="Cantidad en stock">
            </div>
            <div class="mb-3">
                <label for="modifyProductImage" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="modifyProductImage">
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>