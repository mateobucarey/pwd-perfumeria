<?php
// Este es un formulario para actualizar al usuario 
// redirige a actualizarLogin.php
include_once('../../configuracion.php');
$titulo = "Gestionar Usuarios";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$listaUsuario = $abmUsuario->buscar($datos);
$objUsuario = $listaUsuario[0];
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h4 class="mb-0">Actualizar Usuario</h4>
                </div>
                <div class="card-body p-4">
                    <form action="../action/actualizarUsuarios.php" method="post">
                        <div class="form-group mb-3">
                            <label for="idusuario">ID:</label>
                            <input type="text" class="form-control" id="idusuario" name="idusuario" value='<?php echo $objUsuario->getIdUsuario() ?>' readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usnombre">Nombre:</label>
                            <input type="text" class="form-control" id="usnombre" name="usnombre" value='<?php echo $objUsuario->getUsNombre() ?>' required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usmail">E-Mail:</label>
                            <input type="email" class="form-control" id="usmail" name="usmail" value='<?php echo $objUsuario->getUsMail() ?>' required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usdeshabilitado">Estado:</label>
                            <select class="form-control" id="usdeshabilitado" name="usdeshabilitado" required>
                                <option value="1" <?php echo ($objUsuario->getUsDeshabilitado() == 1) ? 'selected' : ''; ?>>Habilitado</option>
                                <option value="0" <?php echo ($objUsuario->getUsDeshabilitado() == 0) ? 'selected' : ''; ?>>Deshabilitado</option>
                            </select>
                        </div>
                        <div class="form-group d-none">
                            <input type="text" class="form-control" id="uspass" name="uspass" value='<?php echo $objUsuario->getUsPass() ?>' hidden>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
