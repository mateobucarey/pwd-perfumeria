<?php
include_once("../../configuracion.php");
$titulo = "Inicio";
include_once("../estructuras/cabeceraInsegura.php");

if ($rol != null) {
    include_once("../estructuras/navegadorSeguro.php");
} else {
    include_once("../estructuras/navegadorInseguro.php");
}
?>

<div class="banner-fijo d-flex">
    <div class="col-6 p-0">
        <img src="../assets/img/banner/banner1.jpeg" class="img-fluid" alt="Banner Izquierdo">
    </div>
    <div class="col-6 p-0">
        <img src="../assets/img/banner/banner2.jpeg" class="img-fluid" alt="Banner Derecho">
    </div>
</div>

<?php if ($rol != null) : ?>
    <div class="container mt-5 text-center">
        <div class="welcome-message p-4 rounded">
            <h2 class="fw-bold">Bienvenido a nuestra tienda de perfumes</h2>
            <p class="lead text-muted">Descubre las fragancias más exclusivas y elegantes. Encuentra el aroma perfecto para cada ocasión.</p>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card text-center">
                    <img src="../assets/img/banner/banner3.jpeg" class="card-img-top" alt="Frase 1">
                    <div class="card-body">
                        <p class="card-text">"Un buen perfume es la forma más elegante de dejar huella."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <img src="../assets/img/banner/banner4.jpeg" class="card-img-top" alt="Frase 2">
                    <div class="card-body">
                        <p class="card-text">"El perfume es la forma más intensa del recuerdo."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Productos</h2>

        <?php
        $datos = data_submitted();
        $objProducto = new AbmProducto();
        $listaProd = $objProducto->buscar($datos);

        if (count($listaProd) > 0) {
            $limiteProductos = 6;
            $totalProductos = min(count($listaProd), $limiteProductos); // Mostrar hasta 6 productos
            $productosPorFila = 3;

            for ($fila = 0; $fila < ceil($totalProductos / $productosPorFila); $fila++) {
                echo "<div class='row mb-4 justify-content-center'>";
                for ($col = 0; $col < $productosPorFila; $col++) {
                    $index = $fila * $productosPorFila + $col;
                    if ($index < $totalProductos) {
                        $producto = $listaProd[$index];
                        echo "<div class='col-lg-4 col-md-6 col-sm-12'>";
                        echo "<div class='card text-center sombraCarta mb-4' style='width: 18rem;'>";
                        echo "<img class='card-img-top' style='height: 16rem;' src='" . $producto->getImagenProducto() . "' alt='" . $producto->getProNombre() . "'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $producto->getProNombre() . "</h5>";
                        echo "<p class='card-text'>Precio: $" . $producto->getProDetalle() . "</p>";
                        echo "<p class='card-text'>Stock: " . $producto->getProCantstock() . "</p>";
                        echo "<a href='login.php' class='btn btn-primary'>Agregar al carrito</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                echo "</div>";
            }
        } else {
            echo '<div class="container mt-5 mb-5">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-md-6">';
            echo '<div class="card p-5">';
            echo "<p class='alert alert-warning text-center'>No hay productos disponibles en este momento.</p>";
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
<?php endif; ?>


<style>
    .welcome-message {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-left: 5px solid #007bff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .welcome-message:hover {
        transform: scale(1.02);
    }
</style>

<?php
include_once("../estructuras/pieDePagina.php");
?>
