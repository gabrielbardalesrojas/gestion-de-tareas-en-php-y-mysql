<?php
//interactua directamente con la base de datos para realizar operaciones 

$mysqli=new mysqli("localhost","root","","cursos");
if($mysqli->connect_error) {
    echo "Error: " . $mysqli->connect_error;
    exit();
}
class TareaDatos {
    //establecer una conexión con la base de datos MySQL.
    private $conexion;

    public function __construct() {
        // Ajusta los detalles según tu configuración
        $this->conexion = new mysqli('localhost', 'root', '', 'cursos');

        // Verificación de la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }
//ejecuta una consulta SQL para insertar un nuevo paciente 
public function agregarTarea($titulo, $contenido, $curso_id, $estado = 'pendiente') {
    $query = "INSERT INTO tareas (titulo, contenido, curso_id, estado, created_At) VALUES ('$titulo', '$contenido', '$curso_id', '$estado', NOW())";
    $this->conexion->query($query);
}

    //ejecuta una consulta SQL para seleccionar todos los pacientes
    public function obtenerTarea() {
        $query = "SELECT t.*, c.nombre FROM tareas t JOIN curso c ON t.curso_id = c.id";
        $result = $this->conexion->query($query);
//se obtienen los datos de la consulta y se guarda en un array y se devuelve al final de la funcion
        $tareas = [];

        while ($row = $result->fetch_assoc()) {
            $tareas[] = $row;
        }

        return $tareas;
    }
    public function borrarTarea($id) {
        $query = "DELETE FROM tareas WHERE id = $id";
        return $this->conexion->query($query);
    }
    public function completarTarea($id) {
        $query = "UPDATE tareas SET estado = 'completado' WHERE id = $id";
        return $this->conexion->query($query);
    }
    public function pendienteTarea($id) {
        $query = "UPDATE tareas SET estado = 'pendiente' WHERE id = $id";
        return $this->conexion->query($query);
    }
   
}



class CursoDatos{
    private $conexion;

    public function __construct() {
        // Ajusta los detalles según tu configuración
        $this->conexion = new mysqli('localhost', 'root', '', 'cursos');

        // Verificación de la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }
//ejecuta una consulta SQL para insertar un nuevo paciente 
    public function agregarCurso($nombre) {
        $query = "INSERT INTO curso (nombre) VALUES ('$nombre')";
        $this->conexion->query($query);
    }
    //ejecuta una consulta SQL para seleccionar todos los pacientes
   
    public function obtenercursos() {
        $query = "SELECT * FROM curso";
        $result = $this->conexion->query($query);
//se obtienen los datos de la consulta y se guarda en un array y se devuelve al final de la funcion
        $cursos = [];

        while ($row = $result->fetch_assoc()) {
            $cursos[] = $row;
        }

        return $cursos;
    }
 
}