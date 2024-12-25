<?php

class Session {

    public function __construct() {
        // Asegurarse de que la sesión esté iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Inicia sesión si las credenciales son válidas.
     * @param string $nombreUsuario
     * @param string $psw
     * @return bool
     */
    public function iniciar($nombreUsuario, $psw) {
        $abmUsuario = new AbmUsuario();

        // Buscar usuario con las credenciales proporcionadas
        $usuarios = $abmUsuario->buscar(['usnombre' => $nombreUsuario, 'uspass' => $psw]);

        if (!empty($usuarios)) {
            $usuario = $usuarios[0]; // Se asume que el nombre de usuario es único
            
            // Guardar información del usuario en la sesión
            $_SESSION['idusuario'] = $usuario->getIdusuario();
            $_SESSION['usnombre'] = $usuario->getUsnombre();
            $_SESSION['usmail'] = $usuario->getUsmail();
            $_SESSION['roles'] = $this->getUserRoles($usuario->getIdusuario());

            return true;
        }
        return false;
    }

    /**
     * Cierra la sesión actual.
     * @return void
     */
    public function cerrar() {
        session_unset();
        session_destroy();
    }

    /**
     * Verifica si hay una sesión activa.
     * @return bool
     */
    public function activa() {
        return isset($_SESSION['idusuario']);
    }

    /**
     * Obtiene los roles de un usuario.
     * @param int $idUsuario
     * @return array
     */
    private function getUserRoles($idUsuario) {
        $abmRol = new AbmRol();
        $roles = $abmRol->buscar(['idusuario' => $idUsuario]);

        // Extraer nombres de roles
        $rolesArray = [];
        foreach ($roles as $rol) {
            $rolesArray[] = $rol->getRoldescripcion();
        }

        return $rolesArray;
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     * @param string $role
     * @return bool
     */
    public function hasRole($role) {
        if ($this->activa() && isset($_SESSION['roles'])) {
            return in_array($role, $_SESSION['roles']);
        }
        return false;
    }

    /**
     * Obtiene información del usuario actual.
     * @return array|null
     */
    public function getUserInfo() {
        if ($this->activa()) {
            return [
                'idusuario' => $_SESSION['idusuario'],
                'usnombre' => $_SESSION['usnombre'],
                'roles' => $_SESSION['roles']
            ];
        }
        return null;
    }
}
