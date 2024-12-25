<?php

class Usuario {
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensajeoperacion;

    public function __construct() {
        $this->idusuario = 0;
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = null;
    }

    public function setear($idusuario, $usnombre, $uspass, $usmail, $usdeshabilitado) {
        $this->setIdusuario($idusuario);
        $this->setUsnombre($usnombre);
        $this->setUspass($uspass);
        $this->setUsmail($usmail);
        $this->setUsdeshabilitado($usdeshabilitado);
    }

    // Getters y Setters
    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getUsnombre() {
        return $this->usnombre;
    }

    public function setUsnombre($usnombre) {
        $this->usnombre = $usnombre;
    }

    public function getUspass() {
        return $this->uspass;
    }

    public function setUspass($uspass) {
        $this->uspass = $uspass;
    }

    public function getUsmail() {
        return $this->usmail;
    }

    public function setUsmail($usmail) {
        $this->usmail = $usmail;
    }

    public function getUsdeshabilitado() {
        return $this->usdeshabilitado;
    }

    public function setUsdeshabilitado($usdeshabilitado) {
        $this->usdeshabilitado = $usdeshabilitado;
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
        $sql = "SELECT * FROM usuario WHERE idusuario = " . $this->getIdusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $registro = $base->Registro();
                    $this->setear(
                        $registro['idusuario'], 
                        $registro['usnombre'], 
                        $registro['uspass'], 
                        $registro['usmail'], 
                        $registro['usdeshabilitado']
                    );
                    $msj = true;
                }
            }
        } else {
            $this->setMensajeoperacion("Usuario->cargar: " . $base->getError());
        }
        return $msj;
    }

    public function insertar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario (usnombre, uspass, usmail, usdeshabilitado) VALUES (
            '" . $this->getUsnombre() . "',
            '" . $this->getUspass() . "',
            '" . $this->getUsmail() . "',
            " . ($this->getUsdeshabilitado() ? "'" . $this->getUsdeshabilitado() . "'" : "NULL") . "
        );";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $this->setIdusuario($base->DevolverID());
                $msj = true;
            } else {
                $this->setMensajeoperacion("Usuario->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->insertar: " . $base->getError());
        }
        return $msj;
    }

    public function modificar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET 
            usnombre = '" . $this->getUsnombre() . "',
            uspass = '" . $this->getUspass() . "',
            usmail = '" . $this->getUsmail() . "',
            usdeshabilitado = " . ($this->getUsdeshabilitado() ? "'" . $this->getUsdeshabilitado() . "'" : "NULL") . "
            WHERE idusuario = " . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Usuario->modificar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->modificar: " . $base->getError());
        }
        return $msj;
    }

    public function eliminar() {
        $msj = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE idusuario = " . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $msj = true;
            } else {
                $this->setMensajeoperacion("Usuario->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->eliminar: " . $base->getError());
        }
        return $msj;
    }

    public function listar($parametro = "") {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario";
        if ($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($registro = $base->Registro()) {
                    $obj = new Usuario();
                    $obj->setear(
                        $registro['idusuario'], 
                        $registro['usnombre'], 
                        $registro['uspass'], 
                        $registro['usmail'], 
                        $registro['usdeshabilitado']
                    );
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeoperacion("Usuario->listar: " . $base->getError());
        }
        return $arreglo;
    }
}
