<?php
include_once('../../configuracion.php');
$titulo = "Agregar Productos";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");

$datos = data_submitted();
$abmProducto = new AbmProducto;

// Recibe desde productos.php el id del producto seleccionado
$busquedaProducto = $abmProducto->buscar($datos);
?>

<div class="container my-5">
    <?php if (count($busquedaProducto) > 0): 
        $producto = $busquedaProducto[0]; ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0"><?= htmlspecialchars($producto->getProNombre()) ?></h4>
                    </div>
                    <div class="card-body">
                        <div id="alertaMensajes"></div> 
                        <form name="formAgregarProducto" id="formAgregarProducto" method="POST" class="row g-3">
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <img class="img-fluid rounded" 
                                     style="max-height: 16rem; object-fit: cover;" 
                                     src="<?= htmlspecialchars($producto->getImagenProducto()) ?>" 
                                     alt="Imagen del Producto">
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idproducto" class="form-label">Código:</label>
                                    <input type="text" id="idproducto" name="idproducto" 
                                           class="form-control-plaintext" 
                                           value="<?= htmlspecialchars($producto->getIdProducto()) ?>" 
                                           readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="pronombre" class="form-label">Nombre:</label>
                                    <input type="text" id="pronombre" name="pronombre" 
                                           class="form-control-plaintext" 
                                           value="<?= htmlspecialchars($producto->getProNombre()) ?>" 
                                           readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="prodetalle" class="form-label">Precio:</label>
                                    <input type="text" id="prodetalle" name="prodetalle" 
                                           class="form-control-plaintext" 
                                           value="<?= '$' . htmlspecialchars($producto->getProDetalle()) ?>" 
                                           readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="cicantidad" class="form-label">Stock:</label>
                                    <input type="text" id="cicantidad" name="cicantidad" 
                                           class="form-control-plaintext" 
                                           value="<?= htmlspecialchars($producto->getProCantstock()) ?>" 
                                           readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad a llevar:</label>
                                    <input type="number" id="cantidad" name="cantidad" 
                                           class="form-control" min="1" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    Agregar al Carrito
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-warning text-center" role="alert">
                    <strong>Error:</strong> El producto no existe o no está disponible.
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="../ajax/validarProductoCarrito.js"></script>

<?php
include_once("../estructuras/pieDePagina.php");
?>
