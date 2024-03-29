

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pacientes del DENTISTA</title>
    <style>
        /* Reset de estilos y configuración básica */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
            justify-content: center; /* Centrar contenido horizontalmente */
        }

        /* Estilos para el formulario flotante */
        #formulario-flotante {
            display: none;
            position: fixed;
            width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el mensaje de confirmación */
        #confirmacionMensaje {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
        }

        /* Estilos para los botones */
        button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #15BDF2  ;
            color: #fff;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #D40FE7 ;
        }
        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 20px auto; /* Margen superior e inferior de 20px, centrado horizontalmente */
            width: 35%; /* Ancho del 80% del contenedor */
        }
       
        .tarea {
            position: relative;
            width: 550px;
            left: 400px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
           /* oveflow-y: auto;*/
            outline: none;
        }
        .tarea h2 {
            margin: 0;
        }
        .tarea p {
            margin: 5px 0;
        }
        .options {
            display: flex;
        }
        .tareas{
            display: block;
        }
        .options .btn_n, .btn_c, .btn_r {
            margin-left: 10px;
            padding: 8px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
           background: white;
            
        }
        .options  img{
           width: 20px;
           height: 20px;
            
        }
        .options .btn_n:hover {
            background-color: #15BDF2 ;
        }
        .options .btn_c:hover {
            background-color: #0BDFF1 ;
        }
        .options .btn_r:hover {
            background-color: black;
        }
        .completado {
            background-color: #ff6347; /* Color rojo */
        }
        /* Estilos para tareas pendientes */
        .pendiente {
            background-color: #32CD32; /* Color verde */
        }
        /* Estilos para el footer */
footer {
    background-color: #15BDF2  ; /* Color de fondo del footer */
    color: black; /* Color del texto */
    padding: 20px; /* Espaciado interno */
    text-align: center; /* Alineación del texto */
    position: relative; /* Fija el footer en la parte inferior */
    width: 100%; /* Ancho completo */
    bottom: 0; /* Lo coloca en la parte inferior */
}

    </style>
     
</head>
<body>
    
    <h1> GESTOR DE TAREAS</h1>
    <script>
        function redirigircurso() {
            window.location.href = 'presentacion/form_curso.php'; }
    </script>
    <button onclick="redirigircurso()">CREAR CURSO</button>
    <script>
        function redirigirtarea() {
            window.location.href = 'presentacion/form_tarea.php'; }
    </script>
    <button onclick="redirigirtarea()">CREAR CURSO</button>
 
    
    <hr>
    <div>
<h1> LISTA DE TAREAS</h1>
<?php
require_once 'negocios/llamar_tarea.php';
$negocios = new TareaNegocios();
$tareas = $negocios->obtenerTarea(); 
if (!empty($tareas)) {
    // Iterar sobre las tareas y mostrarlas
    foreach ($tareas as $tarea) {
        
        $color = ($tarea['estado']== "completado") ? '#F85808 ' : '#10F659';
        echo "<div class='tarea' style='background-color: $color;' >";
        echo "<div class='tareas'>";
        echo "<h2>{$tarea['titulo']}</h2>";
        echo "<p>CURSO: {$tarea['nombre']}</p>";
        echo "<p style='background-color: #014ECC ; border-radius: 3px;'> {$tarea['created_at']}</p>";
        echo "<p>{$tarea['estado']}</p>";
        echo "</div>";
        echo "<div class='options'>";
        
        echo "<button class='btn_n' onclick='completarTarea({$tarea['id']})'><img src='img/completado.png'></button>";
        echo "<button class='btn_n' onclick='pendienteTarea({$tarea['id']})'><img src='img/pendiente.png'></button>";
        echo "<button class='btn_r' onclick='borrarTarea({$tarea['id']})'><img src='img/borrar.png'></button>";

        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No hay tareas disponibles.</p>";
}
?>
</div>
<script>
    function borrarTarea(id) {
        if (confirm("¿Estás seguro de que quieres borrar esta tarea?")) {
            // Realiza una solicitud AJAX para borrar la tarea con su ID
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "negocios/borrar_tarea.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Si la tarea se eliminó correctamente, recarga la página para actualizar la lista de tareas
                        window.location.reload();
                    } else {
                        // Maneja cualquier error que pueda ocurrir durante la eliminación de la tarea
                        console.error("Error al borrar la tarea");
                    }
                }
            };
            xhr.send("id=" + id);
        }
    }

    function completarTarea(id) {
        if (confirm("¿Estás seguro de que quieres marcar esta tarea como completada?")) {
            // Realiza una solicitud AJAX para marcar la tarea como completada en la base de datos
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "negocios/completar_tarea.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Si se actualizó el estado correctamente, recarga la página para reflejar el cambio
                        window.location.reload();
                    } else {
                        // Maneja cualquier error que pueda ocurrir durante la actualización del estado
                        console.error("Error al completar la tarea");
                    }
                }
            };
            xhr.send("id=" + id);
        }
    }
    function pendienteTarea(id) {
        if (confirm("¿Estás seguro de que quieres marcar esta tarea como pendiente?")) {
            // Realiza una solicitud AJAX para marcar la tarea como completada en la base de datos
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "negocios/pendiente_tarea.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Si se actualizó el estado correctamente, recarga la página para reflejar el cambio
                        window.location.reload();
                    } else {
                        // Maneja cualquier error que pueda ocurrir durante la actualización del estado
                        console.error("Error poner pendiente la tarea");
                    }
                }
            };
            xhr.send("id=" + id);
        }
    }
</script>

   <!-- Footer -->
<footer >
    <p>© 2024 Nombre de tu proyecto. Todos los derechos reservados.</p>
    <p>Este proyecto es solo con fines educativos y de prueba. No representa un sistema funcional completo y no debe ser utilizado en un entorno de producción.</p>
</footer>

   
</body>
</html>
