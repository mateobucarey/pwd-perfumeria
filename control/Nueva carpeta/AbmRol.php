<?php

class AbmRol {

    /**
     * Carga un objeto con los parámetros proporcionados.
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param){
        $obj = null;
        if(array_key_exists('idrol', $param) && array_key_exists('rodescripcion', $param)){
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['rodescripcion']);
        }
        return $obj;
    }

    /**
     * Carga un objeto solo con la clave primaria.
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idrol'])){
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
        }
        return $obj;
    }

    /**
     * Verifica si están seteados los campos clave en el arreglo.
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        return isset($param['idrol']);
    }

    /**
     * Permite insertar un objeto.
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idrol'] = null;
        $objRol = $this->cargarObjeto($param);
        if ($objRol != null && $objRol->insertar()){
            $resp = true;
        }
        return $resp;
    }

    /**
     * Permite eliminar un objeto.
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjetoConClave($param);
            if ($objRol != null && $objRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite modificar un objeto.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjeto($param);
            if($objRol != null && $objRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar objetos.
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param != NULL){
            if (isset($param['idrol']))
                $where .= " and idrol = '".$param['idrol']."'";
            if (isset($param['rodescripcion']))
                $where .= " and rodescripcion LIKE '%".$param['rodescripcion']."%'";
        }
        $arreglo = Rol::listar($where);  
        return $arreglo;
    }
}
