<?php
include_once("../../configuracion.php");
$titulo = "Productos";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
?>

<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h1 class="font-weight-bold">Productos</h1>
    </div>

    <?php
    $datos = data_submitted();
    $objProducto = new AbmProducto();
    $listaProd = $objProducto->buscar($datos);

    if(count($listaProd) > 0){
        echo "<div class='row'>";
        for ($i = 0; $i < count($listaProd); $i++) {
            echo "<div class='col-md-4 mb-4'>";
            echo "<div class='card text-center shadow' style='width: 100%;'>";
            echo "<img class='card-img-top' style='height: 16rem; object-fit: cover;' src='" . $listaProd[$i]->getImagenProducto() . "' alt='" . $listaProd[$i]->getProNombre() . "'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $listaProd[$i]->getProNombre() . "</h5>";
            echo "<p class='card-text'>Precio: $" . $listaProd[$i]->getProDetalle() . "</p>";
            echo "<p class='card-text'>Stock: " . $listaProd[$i]->getProCantstock() . "</p>";
            echo "<a href='agregarProductoAlCarrito.php?idproducto=" . $listaProd[$i]->getIdProducto() . "' class='btn btn-primary'>Agregar al carrito</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
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

<?php
include_once("../estructuras/pieDePagina.php");
?>
