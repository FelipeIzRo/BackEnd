<?php
abstract class Item{
    
    protected $titulo;
    protected $autor;
    protected $editor;
    protected $anio;

    public function __construct($titulo,$autor,$editor,$anio) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editor = $editor;
        $this->anio = $anio;
    }

    public function getDatos(){
        echo "Titulo:" . $this->titulo . "<br>";
        echo "Autor:" . $this->autor . "<br>";
        echo "Editor:" . $this->editor . "<br>";
        echo "Anio:" . $this->anio . "<br>";
    }
}
?>