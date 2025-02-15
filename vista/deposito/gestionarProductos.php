<?php
include_once("../../configuracion.php");
$titulo = "Gestionar Productos";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
$objAbmProducto = new AbmProducto();

// Desde aquí se puede ver la lista de productos y modificarla
$listaProductos = $objAbmProducto->buscar(null);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Gestión de Productos</h2>

    <?php
    if (count($listaProductos) > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-hover shadow-lg rounded">';
        echo '<thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre Producto</th>
                    <th scope="col">Detalle Producto</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Opciones</th>
                </tr>
              </thead>';
        echo '<tbody>';
        for ($i = 0; $i < count($listaProductos); $i++) {
            $objProducto = $listaProductos[$i];
            
            echo '<tr>
                    <td><img src="' . $objProducto->getImagenProducto() . '" class="img-fluid rounded" width="100px"></td>
                    <td>' . $objProducto->getProNombre() . '</td>
                    <td>$' . $objProducto->getProDetalle() . '</td>
                    <td>' . $objProducto->getProCantstock() . '</td>
                    <td><a href="modificarProductos.php?idproducto=' . $objProducto->getIdProducto() . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Modificar</a></td>
                  </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-info text-center" role="alert"><i class="fas fa-info-circle"></i> No se encontraron productos.</div>';
    }
    ?>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
