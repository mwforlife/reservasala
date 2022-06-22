<?php
class Bloque{
    private $id;
    private $nombre;
    private $horario;

    public function Bloque($id, $nombre, $horario){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->horario = $horario;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getHorario(){
        return $this->horario;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setHorario($horario){
        $this->horario = $horario;
    }
}