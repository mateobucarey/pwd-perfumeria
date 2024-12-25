<?php

class CompraEstado {
    private $idcompraestado;
    private $objCompra;
    private $objCompraEstadoTipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct() {
        $this->idcompraestado = 0;
        $this->objCompra = new Compra();
        $this->objCompraEstadoTipo = new CompraEstadoTipo();
        $this->cefechaini = "0000-00-00 00:00:00";
        $this->cefechafin = null;
    }

    public function setear($idcompraestado, $objCompra, $objCompraEstadoTipo, $cefechaini, $cefechafin) {
        $this->setIdcompraestado($idcompraestado);
        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setCefechaini($cefechaini);
        $this->setCefechafin($cefechafin);
    }

    // Getters y Setters
    public function getIdcompraestado() {
        return $this->idcompraestado;
    }

    public function setIdcompraestado($idcompraestado) {
        $this->idcompraestado = $idcompraestado;
    }

    public function getObjCompra() {
        return $this->objCompra;
    }

    public function setObjCompra($objCompra) {
        $this->objCompra = $objCompra;
    }

    public function getObjCompraEstadoTipo() {
        return $this->objCompraEstadoTipo;
    }

    public function setObjCompraEstadoTipo($objCompraEstadoTipo) {
        $this->objCompraEstadoTipo = $objCompraEstadoTipo;
    }

    public function getCefechaini() {
        return $this->cefechaini;
    }

    public function setCefechaini($cefechaini) {
        $this->cefechaini = $cefechaini;
    }

    public function getCefechafin() {
        return $this->cefechafin;
    }

    public function setCefechafin($cefechafin) {
        $this->cefechafin = $cefechafin;
    }

    public function getMensajeoperacion() {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion) {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    // Métodos principales
    public function cargar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    
                    $objCompra = new Compra();
                    $objCompra->setIdcompra($registro['idcompra']);
                    $objCompra->cargar();

                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->setIdcompraestadotipo($registro['idcompraestadotipo']);
                    $objCompraEstadoTipo->cargar();

                    $this->setear(
                        $registro['idcompraestado'], 
                        $objCompra, 
                        $objCompraEstadoTipo, 
                        $registro['cefechaini'], 
                        $registro['cefechafin']
                    );
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES (
            '" . $this->getObjCompra()->getIdcompra() . "',
            '" . $this->getObjCompraEstadoTipo()->getIdcompraestadotipo() . "',
            '" . $this->getCefechaini() . "',
            " . ($this->getCefechafin() ? "'" . $this->getCefechafin() . "'" : "NULL") . "
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstado->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraestado SET 
            idcompra = '" . $this->getObjCompra()->getIdcompra() . "', 
            idcompraestadotipo = '" . $this->getObjCompraEstadoTipo()->getIdcompraestadotipo() . "',
            cefechaini = '" . $this->getCefechaini() . "',
            cefechafin = " . ($this->getCefechafin() ? "'" . $this->getCefechafin() . "'" : "NULL") . "
            WHERE idcompraestado = " . $this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstado->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraestado WHERE idcompraestado = " . $this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstado->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestado";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $objCompra = new Compra();
                    $objCompra->setIdcompra($registro['idcompra']);
                    $objCompra->cargar();

                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->setIdcompraestadotipo($registro['idcompraestadotipo']);
                    $objCompraEstadoTipo->cargar();

                    $obj = new CompraEstado();
                    $obj->setear(
                        $registro['idcompraestado'], 
                        $objCompra, 
                        $objCompraEstadoTipo, 
                        $registro['cefechaini'], 
                        $registro['cefechafin']
                    );

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
