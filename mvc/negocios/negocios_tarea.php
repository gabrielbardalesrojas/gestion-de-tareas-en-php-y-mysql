<?php
//Se incluye el archivo de datos datos.php utilizando require_once.
require_once '../acceso/datos.php';

//Se define la clase PacienteNegocios
class TareaNegocios {
    private $datos;

    public function __construct() {
        $this->datos = new TareaDatos();
    }
//utiliza el objeto $datos para agregar un nuevo paciente a la base de datos.
    public function agregarTarea($titulo, $contenido, $curso_id) {
        $this->datos->agregarTarea($titulo, $contenido, $curso_id);
    }
    //para obtener la lista de pacientes desde la base de datos.
    public function obtenerTarea() {
        return $this->datos->obtenerTarea();
    }
    

    
}

// Función para obtener los cursos desde la base de datos

// Iniciar o reanudar la sesión
session_start();


// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y Se filtran y validan los datos del formulario 
    $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $contenido = filter_input(INPUT_POST, "contenido", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $curso_id = filter_input(INPUT_POST, "curso_id", FILTER_VALIDATE_INT);
   

    // Crear instancia de PacienteNegocios y agregar paciente
    $negocios = new  TareaNegocios();
    $negocios->agregarTarea($titulo, $contenido, $curso_id);

    
    // Redirigir al formulario para permitir más ingresos
    header("Location: ../index.php");
    exit();
}


// Cerrar la sesión
session_write_close();

