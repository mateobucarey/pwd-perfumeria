<?php

class UsuarioRol {
    private $idusuario;
    private $idrol;
    private $mensajeoperacion;

    public function __construct() {
        $this->idusuario = 0;
        $this->idrol = 0;
    }

    public function setear($idusuario, $idrol) {
        $this->setIdusuario($idusuario);
        $this->setIdrol($idrol);
    }

    // Getters y Setters
    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
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
    public function cargar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario = " . $this->getIdusuario() . " AND idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear($registro['idusuario'], $registro['idrol']);
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idusuario, idrol) VALUES (
            " . $this->getIdusuario() . ",
            " . $this->getIdrol() . "
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar($nuevoIdrol) {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuariorol SET 
            idrol = " . $nuevoIdrol . " 
            WHERE idusuario = " . $this->getIdusuario() . " AND idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $this->setIdrol($nuevoIdrol); // Actualizar el atributo de la clase
                $msj = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuariorol WHERE idusuario = " . $this->getIdusuario() . " AND idrol = " . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new UsuarioRol();
                    $obj->setear($registro['idusuario'], $registro['idrol']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
