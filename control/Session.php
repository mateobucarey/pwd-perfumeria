<?php
class Session {
    
    public function __construct()
    {
        $resp = true;
        if (!session_start()) {
            $resp = false;
        }
        return $resp;
    }

    /**
     * Valida el logueo y actualiza las variables de sesión con los valores ingresados
     * @param string $nombreUsuario
     * @param string $psw
     * @return boolean
     */
    public function iniciar($nombreUsuario, $psw)
    {
        $resp = false;
        $objAbmUsuario = new AbmUsuario();
  
        $param['usnombre'] = $nombreUsuario;
        $param['uspass'] = $psw;
        $param['usdeshabilitado'] = '0000-00-00 00:00:00';

        $colUsuarios = $objAbmUsuario->buscar($param);

        if (count($colUsuarios) > 0) {

            $usuario = $colUsuarios[0];

            $idusuario = $usuario->getIdUsuario();
            $paramRoles['idusuario'] = $idusuario;

            $colObjRol = $objAbmUsuario->buscarRoles($paramRoles);

            $colroles = array();

            for($i=0; $i < count($colObjRol); $i++){
                $colroles[] = $colObjRol[$i]->getIdRol();
            }

            if (count($colObjRol) > 0) {
                $_SESSION['idusuario'] = $usuario->getIdUsuario();
                $_SESSION['usnombre'] = $usuario->getUsNombre();
                $_SESSION['usmail'] = $usuario->getUsMail();
                $_SESSION['idrol'] = $colObjRol[0]->getIdRol(); 
                $_SESSION['colroles'] = $colroles; 

                $resp = true;
            }
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     * @return boolean
     */
    public function validar()
    {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario'])) {
            
            $objAbmUsuario = new AbmUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $param['usdeshabilitado'] = '0000-00-00 00:00:00';
            $colUsuario = $objAbmUsuario->buscar($param);

            if(count($colUsuario) > 0){
                $resp = true;
            }
        }

        return $resp;
    }

    /**
     * Devuelve true o false si la sesión está activa o no.
     * @return boolean
     */
    public function activa()
    {
        $resp = false;
        if (php_sapi_name() !== 'cli') {
            if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                $resp = session_id() === '' ? false : true;
            }
        }
        return  $resp;
    }

    /**
     * Valida si el usuario tiene el rol (permiso) para entrar a una página
     * @return boolean
     */
    public function permiso()
    {
        $resp = false;

        $rutaArchivo = $_SERVER['PHP_SELF']; 
        $colDireccionesRuta = explode("/", $rutaArchivo); 
        $direccionMenu = $colDireccionesRuta[count($colDireccionesRuta) - 1];

        $objMenuRol = new MenuRol();
        if ($objMenuRol->verificarPermiso($_SESSION["idusuario"], $direccionMenu)) {
            $resp = true;
        }

        return $resp;
    }

    /**
     * Redirecciona al usuario hacia la página principal
     */
    public function redireccion(){
        $rutaArchivo = $_SERVER['PHP_SELF']; 
        $colDireccionesRuta = explode("/", $rutaArchivo);
        $direccionPadre = $colDireccionesRuta[count($colDireccionesRuta) - 2];

        if ($direccionPadre == "inicio") {
            header("Location: home.php");
        } else {
            header("Location: ../inicio/home.php");
        }
    }

    /**
     * Retorna un string con el nombre de la carpeta padre de la dirección de menú
     * que se encuentra abierta
     * @return string
     */
    public function getDireccionMenu(){
        $rutaArchivo = $_SERVER['PHP_SELF']; 
        $colDireccionesRuta = explode("/", $rutaArchivo); 
        $direccionMenu = $colDireccionesRuta[count($colDireccionesRuta) - 1];

        return $direccionMenu;
    }

    /**
     * Retorna un string con el nombre de la carpeta padre de la dirección de menú
     * que se encuentra abierta
     * @return string
     */
    public function getDireccionMenuPadre(){
        $rutaArchivo = $_SERVER['PHP_SELF']; 
        $colDireccionesRuta = explode("/", $rutaArchivo); 
        $direccionPadre = $colDireccionesRuta[count($colDireccionesRuta) - 2];

        return $direccionPadre;
    }

    /**
     * Cierra la sesión actual
     * @return boolean
     */
    public function cerrar()
    {
        $resp = true;
        session_destroy();
        return $resp;
    }

    /**
     * Devuelve un entero con el ID de usuario del usuario activo o null si no existe
     * @return int
     */
    public function getIdUsuario()
    {
        $idUsuario = null;
        if ($this->validar()) {
            $idUsuario = $_SESSION['idusuario'];
        }
        return $idUsuario;
    }

    /**
     * Devuelve un string con el nombre del usuario activo o null si no existe
     * @return string
     */
    public function getUsNombre()
    {
        $usNombre = null;
        if ($this->validar()) {
            $usNombre = $_SESSION['usnombre'];
        }
        return $usNombre;
    }

    /**
     * Devuelve un entero con el rol activo del usuario activo o null si no existe
     * @return int
     */
    public function getIdRol()
    {
        $idRol = null;
        if ($this->validar()) {
            $idRol = $_SESSION['idrol'];
        }
        return $idRol;
    }

    /**
     * Devuelve un string con la dirección de mail del usuario activo o null si no existe
     * @return string
     */
    public function getUsMail()
    {
        $usMail = null;
        if ($this->validar()) {
            $usMail = $_SESSION['usmail'];
        }
        return $usMail;
    }

    /**
     * Devuelve una colección de enteros que representa todos los roles
     * que posee el usuario activo o null si no existe
     * @return array
     */
    public function getColeccionRoles()
    {
        $colRoles = null;
        if ($this->validar()) {
            $objAbmUsuario = new AbmUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $colObjRoles = $objAbmUsuario->buscarRoles($param);

            $colRoles = array();

            for($i=0; $i < count($colObjRoles); $i++){
                $colRoles[] = $colObjRoles[$i]->getIdRol();
            }
        }
        return $colRoles;
    }

    /**
     * Devuelve el objUsuario activo
     * @return Usuario
     */
    public function getObjUsuario()
    {
        $usuario = null;
        if ($this->validar()) {
            $obj = new AbmUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->buscar($param);
            if (count($resultado) > 0) {
                $usuario = $resultado[0]->getUsNombre();
            }
        }
        return $usuario;
    }

    /**
     * Devuelve un array con todos los objetos Rol del usuario activo
     * @return array
     */
    public function getColObjRoles()
    {
        $roles = null;
        if ($this->validar()) {
            $objAbmUsuario = new AbmUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $roles = $objAbmUsuario->buscarRoles($param);
        }
        return $roles;
    }

    /**
     * Devuelve un array con una colección de objetos Menu que corresponde a las direcciones
     * habilitadas para el rol activo
     * @return array
     */
    public function getColeccionMenu()
    {
        $paramMenuRol['idrol'] = $_SESSION['idrol'];
        $objMenuRol = new AbmMenuRol;
        $colMenuRol = $objMenuRol->buscar($paramMenuRol);

        $colMenu = [];
        for ($i=0; $i < count($colMenuRol); $i++){
            $colMenu[] = $colMenuRol[$i]->getObjMenu();
        }
        return $colMenu;
    }

    /**
     * Recibe un entero con el nuevo id de rol activo del usuario activo
     * @param int $idRol
     */
    public function modificarIdRol($idRol)
    {
        $_SESSION['idrol'] = $idRol;
    }

    /**
     * Recibe un string con el nuevo mail del usuario activo
     * @param string $usmail
     */
    public function modificarEmail($usmail){
        $_SESSION['usmail']= $usmail;
    }

    /**
     * Recibe un string  con el nuevo nombre del usuario activo
     * @param string $usnombre
     */
    public function modificarNombre($usnombre){
        $_SESSION['usnombre']= $usnombre;
    }
}
?>