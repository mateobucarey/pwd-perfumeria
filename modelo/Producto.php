<?php

class Producto {
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $mensajeoperacion;

    public function __construct() {
        $this->idproducto = 0;
        $this->pronombre = 0;
        $this->prodetalle = "";
        $this->procantstock = 0;
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock) {
        $this->setIdproducto($idproducto);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
    }

    // Getters y Setters
    public function getIdproducto() {
        return $this->idproducto;
    }

    public function setIdproducto($idproducto) {
        $this->idproducto = $idproducto;
    }

    public function getPronombre() {
        return $this->pronombre;
    }

    public function setPronombre($pronombre) {
        $this->pronombre = $pronombre;
    }

    public function getProdetalle() {
        return $this->prodetalle;
    }

    public function setProdetalle($prodetalle) {
        $this->prodetalle = $prodetalle;
    }

    public function getProcantstock() {
        return $this->procantstock;
    }

    public function setProcantstock($procantstock) {
        $this->procantstock = $procantstock;
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
        $sql = "SELECT * FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear(
                        $registro['idproducto'], 
                        $registro['pronombre'], 
                        $registro['prodetalle'], 
                        $registro['procantstock']
                    );
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("Producto->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO producto (idproducto, pronombre, prodetalle, procantstock) VALUES (
            " . $this->getIdproducto() . ",
            " . $this->getPronombre() . ",
            '" . $this->getProdetalle() . "',
            " . $this->getProcantstock() . "
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Producto->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET 
            pronombre = " . $this->getPronombre() . ",
            prodetalle = '" . $this->getProdetalle() . "',
            procantstock = " . $this->getProcantstock() . " 
            WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Producto->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto = " . $this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Producto->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new Producto();
                    $obj->setear(
                        $registro['idproducto'], 
                        $registro['pronombre'], 
                        $registro['prodetalle'], 
                        $registro['procantstock']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("Producto->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
