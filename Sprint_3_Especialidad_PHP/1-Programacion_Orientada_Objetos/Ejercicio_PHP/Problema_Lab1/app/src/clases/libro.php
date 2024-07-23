<?php
require_once('item.php');
class Libro extends Item {
    
    private $numero_pg;

    public function __construct($titulo,$autor,$editor,$anio,$numero_pg) {
        parent::__construct($titulo,$autor,$editor,$anio,$numero_pg);
        $this->numero_pg = $numero_pg;
    }

    public function getDatos(){
        parent::getDatos();
        echo "Numero de paginas:" . $this->numero_pg . "<br>";
    }
}
?>