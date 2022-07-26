<?php
class Usuarios{
    private $id;
    private $rut;
    private $nombre;
    private $apellido;
    private $correo;
    private $registro;

    public function Usuarios($id, $rut, $nombre, $apellido, $correo, $registro){
        $this->id = $id;
        $this->rut = $rut;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->registro = $registro;
    }

    public function getId(){
        return $this->id;
    }

    public function getRut(){
        return $this->rut;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getRegistro(){
        return $this->registro;
    }

    public function setId($id){
        $this->id = $id;
    }

    
    public function setRut($rut){
        $this->rut = $rut;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setRegistro($registro){
        $this->registro = $registro;
    }

}