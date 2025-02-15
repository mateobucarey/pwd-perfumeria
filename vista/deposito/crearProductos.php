<?php
include_once("../../configuracion.php");
$titulo = "Crear Productos";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Crear Producto</h4>
                </div>
                <div class="card-body">
                    <form action="../action/agregarProducto.php">
                        <div class="form-group">
                            <label for="pronombre" class="form-label">
                                <i class="fas fa-box"></i> Nombre del Producto:
                            </label>
                            <input type="text" class="form-control" name="pronombre" id="pronombre" placeholder="Ej. Nombre">
                        </div>

                        <div class="form-group">
                            <label for="prodetalle" class="form-label">
                                <i class="fas fa-tag"></i> Precio:
                            </label>
                            <input type="text" class="form-control" name="prodetalle" id="prodetalle" placeholder="Ej. 500.00">
                        </div>

                        <div class="form-group">
                            <label for="procantstock" class="form-label">
                                <i class="fas fa-boxes"></i> Stock:
                            </label>
                            <input type="text" class="form-control" name="procantstock" id="procantstock" placeholder="Ej. 100">
                        </div>

                        <div class="form-group">
                            <label for="imagenproducto" class="form-label">
                                <i class="fas fa-image"></i> URL de la Imagen:
                            </label>
                            <input type="text" class="form-control" name="imagenproducto" id="imagenproducto" placeholder="Ej. imagen.jpeg">
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                            <i class="fas fa-check"></i> Crear Producto
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
