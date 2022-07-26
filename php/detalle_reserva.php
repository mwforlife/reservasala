<?php
class Detalle_Reserva{
    private $id;
    private $cantidad_alumnos;
    private $sala;
    private $curso;
    private $asignatura;
    private $fecha;
    private $bloque;
    private $docente;

    public function Detalle_Reserva($id, $cantidad_alumnos, $sala, $curso, $asignatura, $fecha, $bloque, $docente){
        $this->id = $id;
        $this->cantidad_alumnos = $cantidad_alumnos;
        $this->sala = $sala;
        $this->curso = $curso;
        $this->asignatura = $asignatura;
        $this->fecha = $fecha;
        $this->bloque = $bloque;
        $this->docente = $docente;
    }

    public function getId(){
        return $this->id;
    }

    public function getCantidad_Alumnos(){
        return $this->cantidad_alumnos;
    }

    public function getSala(){
        return $this->sala;
    }

    public function getCurso(){
        return $this->curso;
    }

    public function getAsignatura(){
        return $this->asignatura;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getBloque(){
        return $this->bloque;
    }

    public function getDocente(){
        return $this->docente;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setCantidad_Alumnos($cantidad_alumnos){
        $this->cantidad_alumnos = $cantidad_alumnos;
    }

    public function setSala($sala){
        $this->sala = $sala;
    }

    public function setCurso($curso){
        $this->curso = $curso;
    }

    public function setAsignatura($asignatura){
        $this->asignatura = $asignatura;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setBloque($bloque){
        $this->bloque = $bloque;
    }

    public function setDocente($docente){
        $this->docente = $docente;
    }

}