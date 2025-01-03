<?php

class AbmMenu{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param){
        $obj = null;
        if( array_key_exists('idmenu', $param) && array_key_exists('menombre', $param) && array_key_exists('medescripcion', $param) && array_key_exists('idpadre', $param) && array_key_exists('medeshabilitado', $param)){
            $obj = new Menu();
            $obj->setear($param['idmenu'], $param['menombre'], $param['medescripcion'], $param['idpadre'], $param['medeshabilitado']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idmenu']) ){
            $obj = new Menu();
            $obj->setear($param['idmenu'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }

    /**
     * permite insertar un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idmenu'] = null;
        $objMenu = $this->cargarObjeto($param);
        if ($objMenu != null && $objMenu->insertar()){
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu != null && $objMenu->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjeto($param);
            if($objMenu != null && $objMenu->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param != NULL){
            if (isset($param['idmenu']))
                $where .= " and idmenu ='".$param['idmenu']."'";
            if (isset($param['menombre']))
                $where .= " and menombre LIKE '%".$param['menombre']."%'";
            if (isset($param['medescripcion']))
                $where .= " and medescripcion LIKE '%".$param['medescripcion']."%'";
            if (isset($param['idpadre']))
                $where .= " and idpadre ='".$param['idpadre']."'";
            if (isset($param['medeshabilitado']))
                $where .= " and medeshabilitado ='".$param['medeshabilitado']."'";
        }
        $obj = new Menu();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

}
