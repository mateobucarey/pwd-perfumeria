<?php include_once("../../configuracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Carrito de Compras</h1>
        <div class="row g-4" id="carrito-container"></div>
        <div class="text-center mt-4">
            <a href="miscompras.html" class="btn btn-primary">Realizar Compra</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cargar productos del carrito
        function cargarCarrito() {
            fetch("carrito.php")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById("carrito-container");
                    container.innerHTML = "";

                    if (data.length === 0) {
                        container.innerHTML = `
                            <div class="col-12">
                                <p class="text-center">El carrito está vacío.</p>
                            </div>`;
                        return;
                    }

                    data.forEach(producto => {
                        const productoHTML = `
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-2">
                                            <img src="${producto.imagen}" class="img-fluid rounded-start" alt="${producto.nombre}">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="card-title">${producto.nombre}</h5>
                                                <p class="card-text">Precio: $${producto.precio}</p>
                                                <p class="card-text">Cantidad: <input type="number" value="${producto.cantidad}" min="1" class="form-control w-25 d-inline"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button class="btn btn-danger mb-2" onclick="quitarDelCarrito(${producto.id})">Quitar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        container.innerHTML += productoHTML;
                    });
                })
                .catch(error => {
                    console.error("Error al cargar el carrito:", error);
                });
        }

        // Quitar producto del carrito
        function quitarDelCarrito(idProducto) {
            fetch("productos.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ action: "quitar", idProducto })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    cargarCarrito();
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error("Error al quitar el producto:", error);
            });
        }

        cargarCarrito();
    </script>
</body>
</html>
