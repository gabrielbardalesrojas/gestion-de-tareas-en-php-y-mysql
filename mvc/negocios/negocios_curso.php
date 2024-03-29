<?php
//Se incluye el archivo de datos datos.php utilizando require_once.
require_once '../acceso/datos.php';
//Se define la clase PacienteNegocios

class CursoNegocios {
    private $datos;

    public function __construct() {
        $this->datos = new CursoDatos();
    }
//utiliza el objeto $datos para agregar un nuevo paciente a la base de datos.
    public function agregarCurso($nombre) {
        $this->datos->agregarCurso($nombre);
    }
    //para obtener la lista de pacientes desde la base de datos.
    /*
    public function obtenerCursos() {
        return $this->datos->obtenerCursos();
    }
    */

    
}

// Función para obtener los cursos desde la base de datos
$cursos=$mysqli->query("SELECT * FROM curso");
// Iniciar o reanudar la sesión
session_start();


// Verificar si se ha enviado el formulario
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y Se filtran y validan los datos del formulario 
    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    

    // Crear instancia de PacienteNegocios y agregar paciente
    $negocios = new CursoNegocios();
    $negocios->agregarCurso($nombre);

    
    // Redirigir al formulario para permitir más ingresos
    header("Location: ../index.php");
    exit();
}

// Cerrar la sesión
session_write_close();

