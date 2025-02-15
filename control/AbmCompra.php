<?php

class AbmCompra{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres 
     * de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param){
        $objCompra = null;
       
        if( 
        array_key_exists('idcompra', $param) &&
        array_key_exists('cofecha', $param) &&
        array_key_exists('idusuario', $param)
        ){
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();

            $objCompra = new Compra();

            $objCompra->setear(
                $param['idcompra'],
                $param['cofecha'],
                $objUsuario
            );
        }
        return $objCompra;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * 
     * OBSERVACION: Se utiliza este método principalmente para borrar un registro, ya que para ello
     * solamente se necesitan las claves del mismo
     * 
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if(isset($param['idcompra']) ){
            $obj = new Compra();
            $obj->setear($param['idcompra'], null, null);
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
        if (isset($param['idcompra']))
            $resp = true;
        return $resp;
    }
    
    /**
     * Esta función carga la información de un objeto a la base de datos
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;

        $param['idcompra'] = null;

        $obj = $this->cargarObjeto($param);
        if ($obj != null && $obj->insertar()){
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Permite eliminar un objeto de la base de datos
     * @param array $param
     * @return boolean
     */
    public function baja($param){

        $resp = false;

        if ($this->seteadosCamposClaves($param)){

        
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null && $obj->eliminar()){
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
    public function modificar($param){
        $resp = false;

        if ($this->seteadosCamposClaves($param)){

            $obj = $this->cargarObjeto($param);
            if($obj != null and $obj->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite buscar un objeto según distintos criterios.
     * Recibe un arreglo indexado que contiene los criterios de busqueda.
     * Retorna un arreglo compuesto por los objetos que cumplen el criterio indicado.
     * @param array $param
     * @return array
     */
    public function buscar($param){

        $where = " true ";

        if ($param <> NULL){

            if  (isset($param['idcompra']))
                $where .= " and idcompra = ".$param['idcompra'];

            if  (isset($param['cofecha']))
                $where.= " and cofecha = '".$param['cofecha']."'";

            if  (isset($param['idusuario']))
                $where.= " and idusuario = ".$param['idusuario'];
        }

        $obj = new Compra();
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

    
    /**
     * Crea un carrito con su estado
     * $param contiene:
     * $param['idusuario']
     */
    public function crearCarrito($param){
        $resp = false;
        
        return $resp;
    }

    /**
     * Recibe un id de usuario y retorna una colección de objeto 
     * compra que no posea un estado de ese usuario.
     * @param int $idUsuario
     * @return array
     */
    public function buscarCarrito($idUsuario){
        $compra = new Compra();
        $sql = "idusuario = ".$idUsuario. " AND 
        NOT EXISTS (
        SELECT * FROM compraestado WHERE compraestado.idcompra = compra.idcompra);";
        $carrito = $compra->listar($sql);
        return $carrito;
    }

    /**
     * Recibe un arreglo indexado que contiene los criterios de busqueda
     * Devuelve un arreglo con la información de todos los objetos que cumplan la condición
     * recibida por parámetro
     * 
     * @param array $param
     * @return array
     */
    public function buscarColInfo($param){

        $colInfo = array();
        $arregloObj = $this->buscar($param);

        if (count($arregloObj) > 0){

            for ($i = 0; $i < count($arregloObj); $i++){
                $colInfo[$i] = $arregloObj[$i]->obtenerInfo();
            }
        }

        return $colInfo;
    }
}

?>