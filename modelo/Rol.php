<?php

class Rol {
    private $idrol;
    private $rodescripcion;
    private $mensajeoperacion;

    public function __construct() {
        $this->idrol = 0;
        $this->rodescripcion = "";
    }

    public function setear($idrol, $rodescripcion) {
        $this->setIdrol($idrol);
        $this->setRodescripcion($rodescripcion);
    }

    // Getters y Setters
    public function getIdrol() {
        return $this->idrol;
    }

    public function setIdrol($idrol) {
        $this->idrol = $idrol;
    }

    public function getRodescripcion() {
        return $this->rodescripcion;
    }

    public function setRodescripcion($rodescripcion) {
        $this->rodescripcion = $rodescripcion;
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
        $sql = "SELECT * FROM rol WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear($registro['idrol'], $registro['rodescripcion']);
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("Rol->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol (rodescripcion) VALUES (
            '" . $this->getRodescripcion() . "'
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $this->setIdrol($base->DevolverID());
                $msj = true;
            } else {
                $this->setMensajeoperacion("Rol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET 
            rodescripcion = '" . $this->getRodescripcion() . "'
            WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Rol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM rol WHERE idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Rol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new Rol();
                    $obj->setear($registro['idrol'], $registro['rodescripcion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("Rol->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
