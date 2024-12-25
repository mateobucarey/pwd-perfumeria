<?php

class AbmMenuRol {

    /**
     * Carga un objeto MenuRol con los datos proporcionados.
     * @param array $param
     * @return MenuRol|null
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('idmenu', $param) && array_key_exists('idrol', $param)) {
            $obj = new MenuRol();
            $obj->setear($param['idmenu'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Carga un objeto MenuRol solo con las claves primarias.
     * @param array $param
     * @return MenuRol|null
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if (isset($param['idmenu']) && isset($param['idrol'])) {
            $obj = new MenuRol();
            $obj->setear($param['idmenu'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * Verifica si los campos clave están configurados.
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        return isset($param['idmenu']) && isset($param['idrol']);
    }

    /**
     * Inserta un nuevo objeto MenuRol.
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $objMenuRol = $this->cargarObjeto($param);
        if ($objMenuRol != null && $objMenuRol->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Elimina un objeto MenuRol existente.
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenuRol = $this->cargarObjetoConClave($param);
            if ($objMenuRol != null && $objMenuRol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica un objeto MenuRol existente.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objMenuRol = $this->cargarObjeto($param);
            if ($objMenuRol != null && $objMenuRol->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Busca objetos MenuRol según criterios.
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        if ($param != NULL) {
            if (isset($param['idmenu']))
                $where .= " and idmenu = '" . $param['idmenu'] . "'";
            if (isset($param['idrol']))
                $where .= " and idrol = '" . $param['idrol'] . "'";
        }
        $arreglo = MenuRol::listar($where);
        return $arreglo;
    }
}
