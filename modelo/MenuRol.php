<?php

class MenuRol {
    private $idmenu;
    private $idrol;
    private $mensajeoperacion;

    public function __construct() {
        $this->idmenu = 0;
        $this->idrol = 0;
    }

    public function setear($idmenu, $idrol) {
        $this->setIdmenu($idmenu);
        $this->setIdrol($idrol);
    }

    // Getters y Setters
    public function getIdmenu() {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu) {
        $this->idmenu = $idmenu;
    }

    public function getIdrol() {
        return $this->idrol;
    }

    public function setIdrol($idrol) {
        $this->idrol = $idrol;
    }

    public function getMensajeoperacion() {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion) {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    // Métodos principales
    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO menurol (idmenu, idrol) VALUES (" . $this->getIdmenu() . ", " . $this->getIdrol() . ");";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("MenuRol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("MenuRol->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM menurol WHERE idmenu = " . $this->getIdmenu() . " AND idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("MenuRol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("MenuRol->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM menurol";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new MenuRol();
                    $obj->setear(
                        $registro['idmenu'],
                        $registro['idrol']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("MenuRol->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
