<?php

class CompraItem {
    private $idcompraitem;
    private $objProducto;
    private $objCompra;
    private $cicantidad;
    private $mensajeoperacion;

    public function __construct() {
        $this->idcompraitem = 0;
        $this->objProducto = new Producto();
        $this->objCompra = new Compra();
        $this->cicantidad = 0;
    }

    public function setear($idcompraitem, $objProducto, $objCompra, $cicantidad) {
        $this->setIdcompraitem($idcompraitem);
        $this->setObjProducto($objProducto);
        $this->setObjCompra($objCompra);
        $this->setCicantidad($cicantidad);
    }

    // Getters y Setters
    public function getIdcompraitem() {
        return $this->idcompraitem;
    }

    public function setIdcompraitem($idcompraitem) {
        $this->idcompraitem = $idcompraitem;
    }

    public function getObjProducto() {
        return $this->objProducto;
    }

    public function setObjProducto($objProducto) {
        $this->objProducto = $objProducto;
    }

    public function getObjCompra() {
        return $this->objCompra;
    }

    public function setObjCompra($objCompra) {
        $this->objCompra = $objCompra;
    }

    public function getCicantidad() {
        return $this->cicantidad;
    }

    public function setCicantidad($cicantidad) {
        $this->cicantidad = $cicantidad;
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
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdcompraitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    
                    $objProducto = new Producto();
                    $objProducto->setIdproducto($registro['idproducto']);
                    $objProducto->cargar();

                    $objCompra = new Compra();
                    $objCompra->setIdcompra($registro['idcompra']);
                    $objCompra->cargar();

                    $this->setear(
                        $registro['idcompraitem'], 
                        $objProducto, 
                        $objCompra, 
                        $registro['cicantidad']
                    );
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("CompraItem->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) VALUES (
            '" . $this->getObjProducto()->getIdproducto() . "',
            '" . $this->getObjCompra()->getIdcompra() . "',
            '" . $this->getCicantidad() . "'
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraItem->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraitem SET 
            idproducto = '" . $this->getObjProducto()->getIdproducto() . "', 
            idcompra = '" . $this->getObjCompra()->getIdcompra() . "', 
            cicantidad = '" . $this->getCicantidad() . "'
            WHERE idcompraitem = " . $this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraItem->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraitem WHERE idcompraitem = " . $this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraItem->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraitem";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $objProducto = new Producto();
                    $objProducto->setIdproducto($registro['idproducto']);
                    $objProducto->cargar();

                    $objCompra = new Compra();
                    $objCompra->setIdcompra($registro['idcompra']);
                    $objCompra->cargar();

                    $obj = new CompraItem();
                    $obj->setear(
                        $registro['idcompraitem'], 
                        $objProducto, 
                        $objCompra, 
                        $registro['cicantidad']
                    );

                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("CompraItem->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
