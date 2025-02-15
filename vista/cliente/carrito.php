<?php
include_once("../../configuracion.php");
$titulo = "Carrito";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");

$idUsuario = $session->getIdUsuario();
$objCompra = new AbmCompra();
$busquedaCompra = $objCompra->buscarCarrito($idUsuario);

if ($busquedaCompra == null) {
    $objAbmNuevaCompra = new AbmCompra();
    $paramCompra['idcompra'] = 0;
    $paramCompra['cofecha'] = '0000-00-00 00:00:00';
    $paramCompra['idusuario'] = $idUsuario;
    $objAbmNuevaCompra->alta($paramCompra);

    $busquedaCompra = $objAbmNuevaCompra->buscarCarrito($idUsuario);
}

$compra = $busquedaCompra[0];
$idUCompra['idcompra'] = $compra->getIdCompra();
$objCompraItem = new AbmCompraItem();
$objProducto = new AbmProducto();
$listaCompraItem = $objCompraItem->buscar($idUCompra);
?>

<body>
<div class="container mt-4">
    <?php
    $montoAPagar = 0;
    if (count($listaCompraItem) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<thead class='bg-dark text-white'>
                <tr>
                    <th scope='col' class='text-center'>Imagen</th>
                    <th scope='col'>Nombre Producto</th>
                    <th scope='col' class='text-center'>Cantidad</th>
                    <th scope='col' class='text-center'>Precio por Unidad</th>
                    <th scope='col' class='text-center'>Opciones</th>
                </tr>
              </thead><tbody>";
        foreach ($listaCompraItem as $item) {
            $idProducto['idproducto'] = $item->getObjProducto()->getIdProducto();
            $busquedaProducto = $objProducto->buscar($idProducto);
            $producto = $busquedaProducto[0];
            $subtotal = $producto->getProDetalle() * $item->getCiCantidad();
            $montoAPagar += $subtotal;

            echo '<tr>
                    <td class="text-center"><img src="' . $producto->getImagenProducto() . '" class="img-thumbnail" style="max-height: 100px;"></td>
                    <td>' . $producto->getProNombre() . '</td>
                    <td class="text-center">' . $item->getCiCantidad() . '</td>
                    <td class="text-center">$' . number_format($producto->getProDetalle(), 2) . '</td>
                    <td class="text-center">
                        <a href="../action/quitarProductoCarrito.php?idcompraitem=' . $item->getIdCompraItem() . '" class="btn btn-danger btn-sm">Quitar</a>
                    </td>
                  </tr>';
        }
        echo '<tr class="bg-light">
                <td colspan="3" class="text-end fw-bold">Total:</td>
                <td class="text-center fw-bold">$' . number_format($montoAPagar, 2) . '</td>
                <td class="text-center">
                    <a href="../action/pagoCompra.php?idusuario=' . $idUsuario . '" class="btn btn-success">Realizar Compra</a>
                </td>
              </tr>';
        echo "</tbody></table></div>";
    } else {
        echo '<div class="container mt-5 mb-5">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card text-center p-5 shadow">';
        echo "<p class='alert alert-warning m-0'>No tiene productos en su carrito.</p>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
<br>
</body>
</html>

<?php
include_once("../estructuras/pieDePagina.php");
?>
