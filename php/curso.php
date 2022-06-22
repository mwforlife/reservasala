<?php
class Curso{
    private $id;
    private $nombre;

    public function Curso($id, $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function serNombre($nombre){
        $this->nombre = $nombre;
    }
}