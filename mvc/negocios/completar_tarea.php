<?php
// Incluye el archivo datos.php para poder utilizar la clase TareaDatos
require_once '../acceso/datos.php';

// Verifica si se recibió un ID válido para la tarea a completar
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Obtiene el ID de la tarea desde la solicitud
    $tarea_id = $_POST['id'];
    
    // Crea una instancia de la clase TareaDatos
    $tareaDatos = new TareaDatos();

    // Intenta marcar la tarea como completada utilizando el método completarTarea() de TareaDatos
    $resultado = $tareaDatos->completarTarea($tarea_id);

    // Verifica si la tarea se completó correctamente
    if($resultado) {
        // Envía una respuesta 200 OK si la tarea se completó correctamente
        http_response_code(200);
        echo "La tarea se ha marcado como completada.";
    } else {
        // Envía una respuesta 500 Internal Server Error si hubo un problema al marcar la tarea como completada
        http_response_code(500);
        echo "Error al marcar la tarea como completada.";
    }
} else {
    // Envía una respuesta 400 Bad Request si no se proporcionó un ID válido para la tarea
    http_response_code(400);
    echo "ID de tarea inválido.";
}

