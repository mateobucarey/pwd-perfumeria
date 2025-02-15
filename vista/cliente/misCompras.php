<?php
include_once "../../configuracion.php";
$titulo = "Mis Compras";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");

?>

<div class="container mt-4 mb-4">
    <h2 class="text-center mb-4">Mis Compras</h2>
    <?php
    $datos['idusuario'] = $session->getIdUsuario(); 
    $objAbmCompra = new AbmCompra();
    $objAbmEstado = new AbmCompraEstado();
    $listaCompra = $objAbmCompra->buscar($datos);

    if (count($listaCompra) > 0) {
        echo '<div class="row g-4">';
        
        foreach ($listaCompra as $objCompra) {
            $bucarCompra = [
                'idcompra' => $objCompra->getIdCompra(),
                'idusuario' => $datos['idusuario']
            ];

            $estadoCompra = $objAbmEstado->buscar($bucarCompra);
            $tipoEstado = "Sin estado";

            if (count($estadoCompra) > 0) {
                foreach ($estadoCompra as $estado) {
                    if ($estado->getCeFechaFin() === '0000-00-00 00:00:00') {
                        $tipoEstado = $estado->getObjCompraEstadoTipo()->getDescripcion();
                        break;
                    }
                }

                // Tarjeta para la compra
                echo '<div class="col-md-6 col-lg-4">';
                echo '<div class="card shadow-sm">';
                echo '<div class="card-header text-center">';
                echo '<h5 class="card-title">Compra #' . $objCompra->getIdCompra() . '</h5>';
                echo '<p class="card-text text-muted">Fecha: ' . $objCompra->getCoFecha() . '</p>';
                echo '</div>';
                echo '<div class="card-body">';

                // Estado de la compra
                $badgeClasses = [
                    "iniciada" => "badge bg-warning text-dark",
                    "aceptada" => "badge bg-primary",
                    "enviada" => "badge bg-success",
                    "cancelada" => "badge bg-danger"
                ];
                $badgeClass = isset($badgeClasses[$tipoEstado]) ? $badgeClasses[$tipoEstado] : "badge bg-secondary";
                echo '<p class="text-center"><span class="' . $badgeClass . '">' . ucfirst($tipoEstado) . '</span></p>';

                // Lista de productos
                echo '<ul class="list-group list-group-flush">';
                $objCompraItem = new AbmCompraItem();
                $objProducto = new AbmProducto();
                $listaCompraItem = $objCompraItem->buscar($bucarCompra);

                $total = 0;
                if (count($listaCompraItem) > 0) {
                    foreach ($listaCompraItem as $item) {
                        $idProducto = ['idproducto' => $item->getObjProducto()->getIdProducto()];
                        $producto = $objProducto->buscar($idProducto)[0];
                        $total += $producto->getProDetalle() * $item->getCiCantidad();

                        echo '<li class="list-group-item d-flex align-items-center">';
                        echo '<img src="' . $producto->getImagenProducto() . '" alt="Producto" class="img-thumbnail me-3" width="50">';
                        echo '<div>';
                        echo '<h6 class="mb-0">' . $producto->getProNombre() . '</h6>';
                        echo '<small class="text-muted">Precio: $' . $producto->getProDetalle() . ' | Cantidad: ' . $item->getCiCantidad() . '</small>';
                        echo '</div>';
                        echo '</li>';
                    }
                }
                echo '</ul>';

                // Total
                echo '<div class="mt-3 text-center">';
                echo '<h5 class="text-success">Total: $' . $total . '</h5>';
                echo '</div>';

                // Acción
                echo '<div class="mt-3 text-center">';
                switch ($tipoEstado) {
                    case 'iniciada':
                        echo '<a href="../action/cancelarCompra.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-danger w-100">Cancelar Compra</a>';
                        break;
                    case 'aceptada':
                        echo '<span class="text-muted">La compra está siendo preparada</span>';
                        break;
                    case 'enviada':
                        echo '<span class="text-muted">La compra ha sido enviada</span>';
                        break;
                    case 'cancelada':
                        echo '<span class="text-muted">La compra ha sido cancelada</span>';
                        break;
                }
                echo '</div>';

                echo '</div>'; // Card body
                echo '</div>'; // Card
                echo '</div>'; // Col
            }
        }

        echo '</div>'; // Row
    } else {
        echo '<div class="alert alert-warning text-center mt-5">No tienes compras registradas.</div>';
    }
    ?>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
