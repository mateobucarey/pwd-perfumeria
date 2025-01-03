<?php

class AbmUsuarioRol {

    /**
     * Espera como parámetro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancia del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param) {
        $obj = null;
        
        if (array_key_exists('idusuario', $param) && array_key_exists('idrol', $param)) {
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Espera como parámetro un arreglo asociativo con las claves que identifican un objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo están seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite insertar un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $param['idusuario'] = null;
        $objUsuarioRol = $this->cargarObjeto($param);
        if ($objUsuarioRol != null && $objUsuarioRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjetoConClave($param);
            if ($objUsuarioRol != null && $objUsuarioRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUsuarioRol = $this->cargarObjeto($param);
            if ($objUsuarioRol != null && $objUsuarioRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        if ($param != NULL) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario = '" . $param['idusuario'] . "'";
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol = '" . $param['idrol'] . "'";
            }
        }
        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
}
?>
