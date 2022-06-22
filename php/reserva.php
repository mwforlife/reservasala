<?php
class Reserva{
    private $id;
    private $cantidad;
    private $sala;
    private $asignatura;
    private $fecha;
    private $curso;
    private $bloque;
    private $usuario;

    public function Reserva($id, $cantidad, $sala, $asignatura, $fecha, $curso, $bloque, $usuario){
        $this->id = $id;
        $this->cantidad = $cantidad;
        $this->sala = $sala;
        $this->asignatura = $asignatura;
        $this->fecha = $fecha;
        $this->curso = $curso;
        $this->bloque = $bloque;
        $this->usuario = $usuario;
    }

    public function getId(){
        return $this->id;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getSala(){
        return $this->sala;
    }

    public function getAsignatura(){
        return $this->asignatura;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getCurso(){
        return $this->curso;
    }

    public function getBloque(){
        return $this->bloque;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setSala($sala){
        $this->sala = $sala;
    }

    public function setAsignatura($asignatura){
        $this->asignatura = $asignatura;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCurso($curso){
        $this->curso = $curso;
    }

    public function setBloque($bloque){
        $this->bloque = $bloque;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

}