<?php
require_once 'acceso/datos.php';
class TareaNegocios {
    private $datos;
    public function __construct() {
        $this->datos = new TareaDatos();
    }

    //para obtener la lista de pacientes desde la base de datos.
    public function obtenerTarea() {
        return $this->datos->obtenerTarea();
    }
    
   
    
}

