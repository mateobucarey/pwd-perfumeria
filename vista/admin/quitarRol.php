<?php

include_once('../../configuracion.php');
$titulo = "Gestionar Usuarios";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
$idUsuario = data_submitted(); 

$objAbmUsuario = new AbmUsuario();
$colObjUsuario = $objAbmUsuario->buscar($idUsuario);
$nombreUsuario = $colObjUsuario[0]->getUsNombre();

$objAbmUsuarioRol = new AbmUsuarioRol();
$colUsuarioRol = $objAbmUsuarioRol->buscar($idUsuario);

$listaRoles = [];

for($i=0; $i < count($colUsuarioRol); $i++){
    $listaRoles[] = $colUsuarioRol[$i]->getObjRol();
}

?>

<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-2 mt-2 text-center">Quitar Rol</h4>
                </div>
                <div class="card-body">
                    <form action="../action/quitarRol.php" method="post">
                        <?php
                        if (count($listaRoles) > 0) {
                            echo "<div class='form-group'>";
                            echo "ID Usuario: <input type='text' class='form-control' id='idusuario' name='idusuario' value=" . $idUsuario['idusuario'] . " readonly>";
                            echo "Nombre Usuario: <input type='text' class='form-control' id='usnombre' name='usnombre' value=" . $nombreUsuario . " readonly><br>";
                            echo "ROLES A QUITAR:<br>";
                            for ($i = 0; $i < count($listaRoles); $i++) {
                                $objRol = $listaRoles[$i];
                                echo "<div class='form-check'>";
                                echo "<input type='checkbox' class='form-check-input' name='idrol' id='idrol' value=" . $objRol->getIdRol() . ">";
                                echo "<label class='form-check-label' for='idrol'>" . $objRol->getRolDescripcion() . "</label>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo '<button type="submit" class="btn btn-danger mt-2">Quitar Roles</button>';
                        } else {
                            echo "<p>No se encontraron Roles</p>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
