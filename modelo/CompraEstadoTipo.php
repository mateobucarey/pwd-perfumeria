<?php

class CompraEstadoTipo {
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;

    public function __construct() {
        $this->idcompraestadotipo = 0;
        $this->cetdescripcion = "";
        $this->cetdetalle = "";
    }

    public function setear($idcompraestadotipo, $cetdescripcion, $cetdetalle) {
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }

    // Getters y Setters
    public function getIdcompraestadotipo() {
        return $this->idcompraestadotipo;
    }

    public function setIdcompraestadotipo($idcompraestadotipo) {
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function getCetdescripcion() {
        return $this->cetdescripcion;
    }

    public function setCetdescripcion($cetdescripcion) {
        $this->cetdescripcion = $cetdescripcion;
    }

    public function getCetdetalle() {
        return $this->cetdetalle;
    }

    public function setCetdetalle($cetdetalle) {
        $this->cetdetalle = $cetdetalle;
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
        $sql = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear($registro['idcompraestadotipo'], $registro['cetdescripcion'], $registro['cetdetalle']);
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO compraestadotipo (cetdescripcion, cetdetalle) VALUES ('" . $this->getCetdescripcion() . "', '" . $this->getCetdetalle() . "');";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE compraestadotipo SET cetdescripcion = '" . $this->getCetdescripcion() . "', cetdetalle = '" . $this->getCetdetalle() . "' WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM compraestadotipo";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new CompraEstadoTipo();
                    $obj->setear($registro['idcompraestadotipo'], $registro['cetdescripcion'], $registro['cetdetalle']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
