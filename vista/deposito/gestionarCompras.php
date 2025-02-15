<?php
include_once("../../configuracion.php");
$titulo = "Gestionar Compras";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Compras</title>    
</head>
<body>

<div class="container mt-4 mb-4">
    <?php
    $objAbmCompra = new AbmCompra();
    $objAbmEstado = new AbmCompraEstado();
    $listaCompra = $objAbmCompra->buscar(null);

    if (count($listaCompra) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead class="thead-light">
                <tr>
                    <th scope="col">ID DE COMPRA</th>
                    <th scope="col">FECHA</th>
                    <th scope="col">ESTADO DE COMPRA</th>
                    <th scope="col">ITEMS</th>
                    <th scope="col">OPCIONES DE COMPRA</th>
                </tr>
              </thead>';
        echo '<tbody>';
        for ($i = 0; $i < count($listaCompra); $i++) {
            $objCompra = $listaCompra[$i];
            $idCompra['idcompra'] = $objCompra->getIdCompra();
            $estadoCompra = $objAbmEstado->buscar($idCompra);

            if (count($estadoCompra) > 0) {
                $resp = false;
                $j = 0;
                $tipoEstado = '';
                while ($j < count($estadoCompra) && $resp == false) {
                    $fechafin = $estadoCompra[$j]->getCeFechaFin();
                    if ($fechafin == '0000-00-00 00:00:00') {
                        $tipoEstado = $estadoCompra[$j]->getObjCompraEstadoTipo()->getDescripcion();
                        $resp = true;
                    }
                    $j++;
                }

                echo '<tr>
                        <td> <div class="textoIdCompra text-center">' . $objCompra->getIdCompra() . '</div></td>
                        <td>' . $objCompra->getCoFecha() . '</td>';
                if ($tipoEstado == "iniciada"){
                    echo '<td> <div class="fondoAmarillo text-center">' . "Iniciada" . '</div></td>';

                } else if ($tipoEstado == "aceptada"){
                    echo '<td> <div class="fondoAzul text-center">' . "Aceptada" . '</div></td>';

                } else if ($tipoEstado == "enviada"){
                    echo '<td> <div class="fondoVerde text-center">' . "Enviada" . '</div></td>';

                } else {
                    echo '<td> <div class="fondoRojo text-center">' . "Cancelada" . '</div></td>';

                }
                
                echo '<td>';

                $objCompraItem = new AbmCompraItem();
                $objProducto = new AbmProducto();
                $listaCompraItem = $objCompraItem->buscar($idCompra);

                if (count($listaCompraItem) > 0) {
                    echo '<table class="table table-bordered">
                            <tr>
                                <th>IMAGEN</th>
                                <th>NOMBRE</th>
                                <th>PRECIO POR UNIDAD</th>
                                <th>CANTIDAD</th>
                                <th>OPCIONES</th>
                            </tr>';

                    $total = 0;

                    for ($p = 0; $p < count($listaCompraItem); $p++) {
                        $objCompraItem = $listaCompraItem[$p];
                        $idProducto['idproducto'] = $objCompraItem->getObjProducto()->getIdProducto();
                        $busquedaProducto = $objProducto->buscar($idProducto);
                        $producto = $busquedaProducto[0];
                        $total = $total + ($producto->getProDetalle() * $objCompraItem->getCiCantidad());

                        echo '<tr>
                                <td><img src=' . $producto->getImagenProducto() . ' width="60px"></td>
                                <td>' . $producto->getProNombre() . '</td>
                                <td> $' . $producto->getProDetalle() . '</td>
                                <td>' . $objCompraItem->getCiCantidad() . '</td>';
                        
                        if($tipoEstado == "cancelada"){
                            echo '<td>Sin Acción</td>';
                        } else {
                            echo '<td><a href="../action/eliminarArticuloCompra.php?idcompraitem=' . $objCompraItem->getIdCompraItem() . '" class="btn btn-warning" >Quitar Producto</a></td>';
                        }
                                
                        echo'</tr>';
                    }
                    echo '<tr><td colspan="5" class="robotoBold">Total: $'.$total.'</td></tr>';
                    echo '</table>';
                }

                echo '</td>
                      <td>';
                
                if ($tipoEstado == 'iniciada') {
                    echo '<div class="d-block"> <a href="../action/aceptarCompra.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-success w-100"  mr-2 >Aceptar Compra</a> 
                          <a href="../action/cancelarCompra.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-danger w-100" >Cancelar Compra</a> </div>';
                } elseif ($tipoEstado == 'aceptada') {
                    echo '<div class="d-block"> <a href="../action/enviarCompra.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-success w-100"  mr-2 >Enviar Compra</a> 
                          <a href="../action/cancelarCompra.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-danger w-100" >Cancelar Compra</a> </div>';
                } elseif ($tipoEstado == 'enviada') {
                    echo '<div class="d-block"> <a href="../action/cancelarCompras.php?idcompra=' . $objCompra->getIdCompra() . '" class="btn btn-danger w-100" >Cancelar Compra</a> </div>';
                } elseif ($tipoEstado == 'cancelada') {
                    echo 'CANCELADA';
                }

                echo '</td>
                      </tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="container mt-5 mb-5">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card p-5">';
        echo '<div class="alert alert-info" role="alert">No se encontraron compras.</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>



</body>
</html>

<?php
include_once("../estructuras/pieDePagina.php");
?>


