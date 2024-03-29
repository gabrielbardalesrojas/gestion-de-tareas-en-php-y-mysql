<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Curso</title>
    <style>
        /* Estilos para el contenedor del formulario */
        #formulario-curso {
            position: relative;
            max-width: 400px;
            top: 150px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Estilos para los títulos */
        #formulario-curso h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilos para las etiquetas */
        #formulario-curso label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Estilos para los campos de entrada */
        #formulario-curso input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Estilos para el botón */
        #formulario-curso button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1EA7F1 ;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .but {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #37C203;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }


        /* Estilos para el botón al pasar el ratón por encima */
        #formulario-curso button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Formulario de Curso -->
    <div id="formulario-curso">
        <h2>Crear Nuevo Curso</h2>
        <form id="form-curso" action="../negocios/negocios_curso.php" method="post">
            <label for="nombre">Nombre del Curso:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <button type="submit" onclick="mostrarMensaje()">CREAR CURSO</button>
            
        </form>
        <br>
        <button class="but" onclick="redirigir()">CANCELAR</button>
    </div>

    <script>
        
        function mostrarMensaje() {
            // Mostrar el mensaje flotante
            var mensaje = document.getElementById("confirmacionMensaje");
            mensaje.style.display = "block";

            // Ocultar el mensaje después de 3 segundos (puedes ajustar el tiempo según tus necesidades)
            setTimeout(function() {
                mensaje.style.display = "none";
            }, 120000);
        }

       
        function redirigir() {
            window.location.href = '../index.php'; }
    </script>
    
 
</body>
</html>
