<?php
include_once("../../configuracion.php");
// Crear una instancia de AbmProducto
$abmProducto = new AbmProducto();

// Buscar todos los productos (puedes ajustar los parámetros según tus necesidades)
$productos = $abmProducto->buscar(null);
?>
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
    <!-- Página de Productos -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos</h1>
        <div class="row">
            <?php
            if (!empty($productos)) {
                foreach ($productos as $producto) {
                    // Suponiendo que cada $producto es una instancia de Producto
                    // y tiene los métodos getPronombre(), getProdetalle(), getProcantstock(), getIdproducto()
                    
                    // Puedes ajustar estos métodos según cómo esté implementada tu clase Producto
                    $nombre = $producto->getPronombre();
                    $detalle = $producto->getProdetalle();
                    $stock = $producto->getProcantstock();
                    $id = $producto->getIdproducto();
                    $img = $producto->getImagenProducto();
                    // Generar una URL de imagen. Aquí uso picsum.photos como ejemplo.
                    // Idealmente, deberías tener una URL de imagen en tu base de datos.
                    //$imagenUrl = "https://picsum.photos/300/200?random=" . $id;
                    
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="' . $img . '" class="card-img-top" alt="' . $nombre . '">
                            <div class="card-body text-center">
                                <h5 class="card-title">' . $nombre . '</h5>
                                <p class="card-text">Precio: $' . $detalle . '</p>
                                <p class="card-text">Stock: ' . $stock . '</p>
                                <button class="btn btn-primary" onclick="agregarAlCarrito(' . $id . ')">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<p class="text-center">No hay productos disponibles.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function agregarAlCarrito(idProducto) {
            // Usar Fetch API para enviar el ID del producto al servidor
            fetch("carrito.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ idProducto: idProducto })
            })
            .then(response => response.text())
            .then(data => {
                alert("Producto agregado al carrito: " + data);
            })
            .catch(error => console.error("Error:", error));
        }
</script>

</body>
</html>
