<?php

// include_once '../modelo/Usuario.php';
class AbmUsuario {

    /**
     * Carga un objeto Usuario con los datos proporcionados.
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('idusuario', $param) && array_key_exists('usnombre', $param) &&
            array_key_exists('uspass', $param) && array_key_exists('usmail', $param) &&
            array_key_exists('usdeshabilitado', $param)) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail'], $param['usdeshabilitado']);
        }
        return $obj;
    }

    /**
     * Carga un objeto Usuario solo con las claves primarias.
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * Verifica si los campos clave están configurados.
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        return isset($param['idusuario']);
    }

    /**
     * Inserta un nuevo usuario.
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $param['idusuario'] = null; // El ID será generado automáticamente.
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario != null && $objUsuario->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Elimina un usuario existente.
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null && $objUsuario->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica un usuario existente.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuario = $this->cargarObjeto($param);
            if ($objUsuario != null && $objUsuario->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca usuarios según criterios.
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        if ($param != NULL) {
            if (isset($param['idusuario']))
                $where .= " and idusuario = '" . $param['idusuario'] . "'";
            if (isset($param['usnombre']))
                $where .= " and usnombre LIKE '%" . $param['usnombre'] . "%'";
            if (isset($param['usmail']))
                $where .= " and usmail LIKE '%" . $param['usmail'] . "%'";
            if (isset($param['usdeshabilitado']))
                $where .= " and usdeshabilitado = '" . $param['usdeshabilitado'] . "'";
        }
        $arreglo = Usuario::listar($where);
        return $arreglo;
    }
}
