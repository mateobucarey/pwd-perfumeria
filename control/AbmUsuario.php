<?php
Class AbmUsuario{
   

    public function abm($datos){
        $resp = false;
        if($datos['accion']=='editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion']=='borrar'){
            if($this->baja($datos)){
                $resp =true;
            }
        }
        if($datos['accion']=='nuevo'){
            if($this->alta($datos)){
                $resp =true;
            }
        }
        if($datos['accion']=='borrar_rol'){
            if($this->borrar_rol($datos)){
                  $resp =true;
        }
        }
        if($datos['accion']=='nuevo_rol'){
           if($this->alta_rol($datos)){
                $resp =true;
        }
            
        }
        return $resp;

    }
    // Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario',$param)  and array_key_exists('usnombre',$param) and array_key_exists('uspass',$param)
        and array_key_exists('usmail',$param) and array_key_exists('usdeshabilitado',$param)){
            $obj = new Usuario();
            $obj->setear($param['idusuario'],$param['usnombre'],$param['uspass'],$param['usmail'],$param['usdeshabilitado']);
        }
        return $obj;
    }
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idusuario']) ){
            $obj = new Usuario();
            $obj->setear($param['idusuario'], null,null,null,null);
        }
        return $obj;
    }
    //Corrobora que dentro del arreglo asociativo estan seteados los campos claves
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idusuario']))
            $resp = true;
        return $resp;
    }
    public function alta($param){
        $resp = false;
        $param['idusuario'] =null;
        $elObjtTabla = $this->cargarObjeto($param);
//        verEstructura($elObjtTabla);
        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = true;
            
        }
        return $resp;
        
    }
    public function borrar_rol($param){
        $resp = false;
        if(isset($param['idusuario']) && isset($param['idrol'])){
            $elObjtTabla = new UsuarioRol();
            $elObjtTabla->setearConClave($param['idusuario'],$param['idrol']);
            $resp = $elObjtTabla->eliminar();
            
        }
       
        return $resp;
        
    }
    public function alta_rol($param){
        $resp = false;
        if(isset($param['idusuario']) && isset($param['idrol'])){
            $elObjtTabla = new UsuarioRol();
            $elObjtTabla->setearConClave($param['idusuario'],$param['idrol']);
            $resp = $elObjtTabla->insertar();
           
           

        }
        echo $resp;
        return $resp;
        
    }
    //permite eliminar un objeto 
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla!=null and $elObjtTabla->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }

    public function modificacion($param){
        //echo "Estoy en modificacion";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    public function darRoles($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
        }
        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        //echo "Van ".count($arreglo);
        return $arreglo;
    }

    public function buscar($param){
        // echo "buscar abmusuario";
        // echo count($param);
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['usnombre']))
                 $where.=" and usnombre ='".$param['usnombre']."'";
            if  (isset($param['usmail']))
                 $where.=" and usmail ='".$param['usmail']."'";
            if  (isset($param['uspass']))
                 $where.=" and uspass ='".$param['uspass']."'";
            if  (isset($param['usdeshabilitado']))
                 $where.=" and usdeshabilitado ='".$param['usdeshabilitado']."'";
        }
        // echo $where;
        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        // echo print_r($arreglo);
        //echo "Van ".count($arreglo);
        return $arreglo;
    }
}