<?php
include_once("../../configuracion.php");
$titulo = "Mi Perfil";
include_once("../estructuras/cabeceraEspecial.php");
include_once("../estructuras/navegadorSeguro.php");

$nombreUsuario = $session->getUsNombre();
$mail = $session->getUsMail();

?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-2 mt-2 text-center">Mi Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="contenedor-dato">
                        <p>Usuario: <span id="nombreUsuario"><?php echo $nombreUsuario ?></span></p>
                    </div>
                    <div class="contenedor-dato">
                        <p>Mail: <span id="mailUsuario"><?php echo $mail ?></span></p>
                    </div>

                    <hr class="card-divider">

                    <form name="formConfiguracionCuenta" id="formConfiguracionCuenta" method="POST" class="needs-validation" novalidate>

                        <div id="alertaMensajes">
                        </div>

                        <div class="contenedor-dato">
                            <label for="uspass" class="form-label">Ingrese su nuevo nombre de usuario</label>
                            <input type="text" class="form-control" id="usnombre" name="usnombre">
                        </div>
                        <br>

                        <div class="contenedor-dato">
                            <label for="usmail" class="form-label">Ingrese su nueva dirección de mail</label>
                            <input type="text" class="form-control" id="usmail" name="usmail">
                        </div>
                        <br>

                        <div class="contenedor-dato">
                            <label for="uspass" class="form-label">Ingrese su nueva contraseña</label>
                            <input type="password" class="form-control" id="uspass" name="uspass">
                        </div>
                        <div class="contenedor-dato">
                            <label for="uspass2" class="form-label">Repita su nueva contraseña</label>
                            <input type="password" class="form-control mb-4" id="uspass2" name="uspass2">
                        </div>
                        <button type="submit" id="realizarCambios" class="btn btn-primary btn-lg w-100">REALIZAR CAMBIOS</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="../ajax/configuracionCuenta.js"></script>

<?php
include_once("../estructuras/pieDePagina.php");
?>