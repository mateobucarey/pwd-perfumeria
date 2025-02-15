<?php
include_once("../../configuracion.php");
$titulo = "Gestionar Usuarios";
include_once("../estructuras/cabeceraSegura.php");
include_once("../estructuras/navegadorSeguro.php");
$objAbmUsuario = new AbmUsuario();
$objAbmUsuarioRol = new AbmUsuarioRol();
$objAbmRol = new AbmUsuarioRol();

$listaUsuarios = $objAbmUsuario->buscar(null);
?>

<div class="container mt-4 mb-4">

    <?php
    if (count($listaUsuarios) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead class="thead-light">
                <tr>
                    <th>ID USUARIO</th>
                    <th>NOMBRE</th>
                    <th>E-MAIL</th>
                    <th>ROL PRINCIPAL</th>
                    <th>FECHA DE DESHABILITADO</th>
                    <th>ACCION</th>
                </tr>
              </thead>';
        echo '<tbody>';
        for ($i = 0; $i < count($listaUsuarios); $i++) {
            $objUsuario = $listaUsuarios[$i];
            $usid['idusuario'] = $objUsuario->getIdUsuario();
            $relacionRol = $objAbmUsuarioRol->buscar($usid);
            if ($relacionRol == null) {
                $rolDesc = "-------";
            } else {
                $rolDesc = $relacionRol[0]->getObjRol()->getRolDescripcion();
            }

            echo '<tr>
                    <td>' . $objUsuario->getIdUsuario() . '</td>
                    <td>' . $objUsuario->getUsNombre() . '</td>
                    <td>' . $objUsuario->getUsMail() . '</td>
                    <td>' . $rolDesc . '</td>
                    <td>' . $objUsuario->getUsDeshabilitado() . '</td>
                    <td class="botonesGestionUsuarios">
                        <a href="formActualizarUsuario.php?idusuario=' . $objUsuario->getIdUsuario() . '" class="btn btn-primary btn-sm m-1">Actualizar</a>
                        <a href="asignarRoles.php?idusuario=' . $objUsuario->getIdUsuario() . '" class="btn btn-info btn-sm m-1">Asignar Roles</a>
                        <a href="quitarRol.php?idusuario=' . $objUsuario->getIdUsuario() . '" class="btn btn-warning btn-sm m-1">Quitar Roles</a>
                        <a href="../action/deshabilitarUsuario.php?idusuario=' . $objUsuario->getIdUsuario() . '" class="btn btn-danger btn-sm m-1">Deshabilitar</a>
                    </td>
                  </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo "<br>";
        
       
    } else {
        echo '<div class="alert alert-info" role="alert">No se encontraron Usuarios.</div>';
    }
    ?>
</div>

<?php
include_once("../estructuras/pieDePagina.php");
?>
<?php	?>

</body>
</html> 