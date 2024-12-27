<?php

Class Usuario{
    private $idUsuario; 
    private $usNombre; 
    private $usPass; 
    private $usMail;
    private $usDeshabilitado;
    private $mensajeoperacion;

    public function __construct(){
        $this->idUsuario="";
        $this->usNombre="";
        $this->usPass="";
        $this->usMail="";
        $this->usDeshabilitado="";
        $this->mensajeoperacion;
    }
    public function setear($idUsuario,$usNombre, $usPass, $usMail,$usDeshabilitado,){
        $this->setIdUsuario($idUsuario);
        $this->setUsNombre($usNombre);
        $this->setUsPass($usPass);
        $this->setUsMail($usMail);
        $this->setUsDeshabilitado($usDeshabilitado);
    }
    
    public function getIdUsuario() {
    	return $this->idUsuario;
    }

    /**
    * @param $idUsuario
    */
    public function setIdUsuario($idUsuario) {
    	$this->idUsuario = $idUsuario;
    }

    public function getUsNombre() {
    	return $this->usNombre;
    }

    /**
    * @param $usNombre
    */
    public function setUsNombre($usNombre) {
    	$this->usNombre = $usNombre;
    }

    public function getUsPass() {
    	return $this->usPass;
    }

    /**
    * @param $usPass
    */
    public function setUsPass($usPass) {
    	$this->usPass = $usPass;
    }

    public function getUsMail() {
    	return $this->usMail;
    }

    /**
    * @param $usMail
    */
    public function setUsMail($usMail) {
    	$this->usMail = $usMail;
    }

    public function getUsDeshabilitado() {
    	return $this->usDeshabilitado;
    }

    /**
    * @param $usDeshabilitado
    */
    public function setUsDeshabilitado($usDeshabilitado) {
    	$this->usDeshabilitado = $usDeshabilitado;
    }
    
   
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
        
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
        
    }
    
    /*Selecciona datos de una tabla*/
    public function cargar($idUsuario){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario WHERE idusuario = ".$idUsuario;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){                  
                    $row = $base->Registro();
                    $this->setear($row,['idusuario'],$row['usnombre'], $row['uspass'],$row['usmail'], $row['usdeshabilitado']);                  
                }
            }
        } else {
            $this->setmensajeoperacion("usuario->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(usnombre, uspass, usmail, usdeshabilitado )  VALUES('".$this->getUsNombre()."','".$this->getUsPass()."','".$this->getUsMail()."','".$this->getUsDeshabilitado()."')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if($id = $base->devuelveIDInsercion($sql)){
                    $this->setIdUsuario($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuario SET usnombre ='".$this->getUsNombre()."',  uspass= '".$this->getUsPass()."',usemail= '".$this->getUsEmail()."',usdeshabilitado= '".$this->getUsDeshabilitado()."' WHERE idusuario='".$this->getIdUsuario()."'";
        // echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idusuario='".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        // echo $sql; hasta aca esta bien 
        $res = $base->Ejecutar($sql);
        // echo $res;
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){

                    $obj= new Usuario();
                    $obj->setear($row['idusuario'],$row['usnombre'], $row['uspass'], $row['usmail'],$row['usdeshabilitado']);
                   
                    
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("usuario->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
    

    
}



    
