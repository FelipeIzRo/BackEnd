<?php
require_once('item.php');
class Revista extends Item {
    
    private $numero_ed;

    public function __construct($titulo,$autor,$editor,$anio,$numero_ed) {
        parent::__construct($titulo,$autor,$editor,$anio,$numero_ed);
        $this->numero_ed = $numero_ed;
    }

    public function getDatos(){
        parent::getDatos();
        echo "Numero de edicion:" . $this->numero_ed . "<br>";
    }
}
?>