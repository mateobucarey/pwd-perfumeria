<?php
include_once("../../configuracion.php");
$titulo = "Crear Cuenta";
include_once("../estructuras/cabeceraInsegura.php");
include_once("../estructuras/navegadorInseguro.php");
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border shadow-sm" style="background-color: #ffffff;">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-2 mt-2 text-center font-weight-bold">Crear Cuenta</h4>
                </div>
                <div class="card-body">
                    <form name="formCrearCuenta" id="formCrearCuenta" method="POST" class="needs-validation">

                        <div id="alertaMensajes"></div>

                        <div class="form-group contenedor-dato">
                            <input 
                                type="text" 
                                class="form-control form-control-lg border" 
                                id="usnombre" 
                                name="usnombre" 
                                placeholder="Nombre de usuario"
                                required>
                        </div>
                        <div class="form-group contenedor-dato mt-3">
                            <input 
                                type="email" 
                                class="form-control form-control-lg border" 
                                id="usmail" 
                                name="usmail" 
                                placeholder="Correo electrónico"
                                required>
                        </div>
                        <button 
                            type="submit" 
                            class="btn btn-success btn-lg w-100 mt-3 font-weight-bold">
                            CREAR CUENTA
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../ajax/validarCrearCuenta.js"></script>

<?php
include_once("../estructuras/pieDePagina.php");
?>
