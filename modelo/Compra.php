<?php

class Compra{

    private $idcompra;
    private $cofecha;
    private $objUsuario;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompra= "";
        $this->cofecha= "0000-00-00 00:00:00";
        $this->objUsuario=new Usuario();
    }

    public function setear($idcompra, $cofecha, $objUsuario){
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setObjUsuario($objUsuario);
    }

    public function getIdcompra() {
    	return $this->idcompra;
    }

    /**
    * @param $idcompra
    */
    public function setIdcompra($idcompra) {
    	$this->idcompra = $idcompra;
    }

    public function getCofecha() {
    	return $this->cofecha;
    }

    /**
    * @param $cofecha
    */
    public function setCofecha($cofecha) {
    	$this->cofecha = $cofecha;
    }

    public function getObjUsuario() {
    	return $this->objUsuario;
    }

    /**
    * @param $objUsuario
    */
    public function setObjUsuario($objUsuario) {
    	$this->objUsuario = $objUsuario;
    }

    public function getMensajeoperacion() {
    	return $this->mensajeoperacion;
    }

    /**
    * @param $mensajeoperacion
    */
    public function setMensajeoperacion($mensajeoperacion) {
    	$this->mensajeoperacion = $mensajeoperacion;
    }

    public function cargar(){
        $msj = false;
        $base=new BaseDatos();
        $sql= "SELECT * FROM compra WHERE idcompra = ".$this->getIdcompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    $registro = $base->Registro();
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($registro['idusuario'])
                    $objUsuario->cargar();
                    $this->setear($registro['idcompra'], $registro['cofecha'], $objUsuario);   
                    $msj = true;
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $msj;    
    }
    
    public function insertar(){

        $msj = false;
        $base=new BaseDatos();
        $sql = "INSERT INTO compra(cofecha, idusuario) VALUES ('".$this->getCofecha()."','".$this->getObjUsuario()->getIdUsuario()."');";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
        }
        return $msj;
    }
    
    public function modificar(){
        $msj = false;
        $base=new BaseDatos();
        $sql="UPDATE compra SET cofecha='". $this->getCofecha()."', idusuario = '". $this->getObjUsuario()->getIdUsuario()."' WHERE idcompra= '".$this->getIdcompra()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setmensajeoperacion("Compra->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar: ".$base->getError());
        }
        return $msj;
    }
    
    public function eliminar(){
        $msj = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compra WHERE idcompra='".$this->getIdcompra()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
        }
        return $msj;
    }
    
    public function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($registro = $base->Registro()){
                    $obj= new Compra();

                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($registro['idusuario']);
                    $objUsuario->cargar();

                    $obj->setear($registro['idcompra'], $registro['cofecha'], $objUsuario);

                    array_push($arreglo, $obj);
                }
            }
        } else {
                $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $arreglo;
    }

}