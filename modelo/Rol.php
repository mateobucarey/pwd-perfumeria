<?php

Class Rol{
    private $idRol; 
    private $rolDescripcion; 
    private $mensajeoperacion;

    public function __construct(){
        $this->idRol="";
        $this->rolDescripcion="";
        $this->mensajeoperacion;
    }
    public function setear($idRol,$rolDescripcion){
        $this->setIdRol($idRol);
        $this->setRolDescripcion($rolDescripcion);
    }
    public function getIdRol() {
    	return $this->idRol;
    }
    public function setIdRol($idRol) {
    	$this->idRol = $idRol;
    }

    public function getRolDescripcion() {
    	return $this->rolDescripcion;
    }
    public function setRolDescripcion($rolDescripcion) {
    	$this->rolDescripcion = $rolDescripcion;
    }
   
    
   
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
        
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
        
    }
    
    /*Selecciona datos de una tabla*/
    public function cargar($idRol){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol WHERE idrol = ".$idRol;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){                  
                    $row = $base->Registro();
                    $this->setear($row,['idrol'],$row['roldescripcion']);                  
                }
            }
        } else {
            $this->setmensajeoperacion("rol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(idrol, roldescripcion)  VALUES('".$this->getIdRol()."','".$this->getRolDescripcion()."')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if($id = $base->devuelveIDInsercion($sql)){
                    $this->setIdRol($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion("rol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->insertar: ".$base->getError());
        }
        return $resp;
    }
}

    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE rol SET roldescripcion ='".$this->getRolDescripcion()."' WHERE idrol='".$this->getIdRol()."'";
        // echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("rol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("rol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){

                    $obj= new Rol();
                    $obj->setear($row['idrol'],$row['roldescripcion']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setmensajeoperacion("rol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
    

    
    }




   

    
