<?php

class Menu {
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    private $mensajeoperacion;

    public function __construct() {
        $this->idmenu = 0;
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = null;
        $this->medeshabilitado = null;
    }

    public function setear($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado) {
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
    }

    // Getters y Setters
    public function getIdmenu() {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu) {
        $this->idmenu = $idmenu;
    }

    public function getMenombre() {
        return $this->menombre;
    }

    public function setMenombre($menombre) {
        $this->menombre = $menombre;
    }

    public function getMedescripcion() {
        return $this->medescripcion;
    }

    public function setMedescripcion($medescripcion) {
        $this->medescripcion = $medescripcion;
    }

    public function getIdpadre() {
        return $this->idpadre;
    }

    public function setIdpadre($idpadre) {
        $this->idpadre = $idpadre;
    }

    public function getMedeshabilitado() {
        return $this->medeshabilitado;
    }

    public function setMedeshabilitado($medeshabilitado) {
        $this->medeshabilitado = $medeshabilitado;
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
        $sql = "SELECT * FROM menu WHERE idmenu = " . $this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear(
                        $registro['idmenu'], 
                        $registro['menombre'], 
                        $registro['medescripcion'], 
                        $registro['idpadre'], 
                        $registro['medeshabilitado']
                    );
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("Menu->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES (
            " . $this->getIdmenu() . ",
            '" . $this->getMenombre() . "',
            '" . $this->getMedescripcion() . "',
            " . ($this->getIdpadre() !== null ? $this->getIdpadre() : "NULL") . ",
            " . ($this->getMedeshabilitado() !== null ? "'" . $this->getMedeshabilitado() . "'" : "NULL") . "
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Menu->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menu->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE menu SET 
            menombre = '" . $this->getMenombre() . "',
            medescripcion = '" . $this->getMedescripcion() . "',
            idpadre = " . ($this->getIdpadre() !== null ? $this->getIdpadre() : "NULL") . ",
            medeshabilitado = " . ($this->getMedeshabilitado() !== null ? "'" . $this->getMedeshabilitado() . "'" : "NULL") . " 
            WHERE idmenu = " . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Menu->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menu->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menu WHERE idmenu = " . $this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Menu->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menu->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new Menu();
                    $obj->setear(
                        $registro['idmenu'], 
                        $registro['menombre'], 
                        $registro['medescripcion'], 
                        $registro['idpadre'], 
                        $registro['medeshabilitado']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("Menu->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
