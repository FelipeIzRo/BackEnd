<?php

require_once('./interfaces/tarea.php');
class Tarea implements TareaInterface{
    private $nombre;
    private $descripcion;

    public function __construct($nombre,$descripcion) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
}

?>