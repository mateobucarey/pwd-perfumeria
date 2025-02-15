<?php
include_once("../../configuracion.php");
$titulo = "Gestionar Productos";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");

// Recibe el idproducto
$datos = data_submitted();
$objProducto = new AbmProducto();
$buscarProducto = $objProducto->buscar($datos);
$producto = $buscarProducto[0];
?>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Modificar Producto</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded">
                <div class="card-header text-black text-center">
                    <h4 class="mb-2">Formulario de Modificación</h4>
                </div>
                <div class="card-body">
                    <form action="../action/modificarProductos.php">
                        <div class="form-group">
                            <label for="idproducto">ID Producto:</label>
                            <input type="text" class="form-control" name="idproducto" id="idproducto" value='<?php echo $producto->getIdProducto(); ?>' readonly>
                        </div>

                        <div class="form-group">
                            <label for="pronombre">Nombre Producto:</label>
                            <input type="text" class="form-control" name="pronombre" id="pronombre" value='<?php echo $producto->getProNombre(); ?>'>
                        </div>

                        <div class="form-group">
                            <label for="prodetalle">Precio:</label>
                            <input type="text" class="form-control" name="prodetalle" id="prodetalle" value='<?php echo $producto->getProDetalle(); ?>'>
                        </div>

                        <div class="form-group">
                            <label for="procantstock">Stock:</label>
                            <input type="text" class="form-control" name="procantstock" id="procantstock" value='<?php echo $producto->getProCantstock(); ?>'>
                        </div>

                        <div class="form-group">
                            <label for="imagenproducto">Imagen:</label>
                            <input type="text" class="form-control" name="imagenproducto" id="imagenproducto" value='<?php echo $producto->getImagenProducto(); ?>'>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">
                            <i class="fas fa-save"></i> Modificar Producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
