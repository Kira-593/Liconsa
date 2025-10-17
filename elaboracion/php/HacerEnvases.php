<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Envases Rotos
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';

// Campos específicos de Envases Rotos (según la estructura de la tabla e_envases_rotos)
$DF = $_POST["DF"] ?? ''; // Defecto de fabricación
$MC = $_POST["MC"] ?? ''; // Manejo de canastilla
$MI = $_POST["MI"] ?? ''; // De manera intencional
$Total = $_POST["Total"] ?? '';


// 2. Consulta para actualizar los datos en la tabla 'e_envases_rotos'
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL. 
// Se recomienda encarecidamente usar sentencias preparadas en producción.
$query = "UPDATE e_envases_rotos SET
            Indicador='$Indicador',
            Mes='$Mes', 
            DF='$DF', 
            MC='$MC', 
            MI='$MI', 
            Total='$Total'
          WHERE id='$ID'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Envases Rotos Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado (asumiendo que existe) -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                // Mensaje actualizado para Envases Rotos
                echo "<div class='mensaje correcto'>Actualización de Envases Rotos correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro.</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- El enlace de regreso debe apuntar a la página que permite seleccionar otro registro de Envases Rotos para modificar. 
             Se asume que la página de selección es ModEnvases.php -->
        <a href="ModEnvases.php" class="btn">Regresar a Actualizar Otro Formulario de Envases</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Inicio'></a>
    </div>
</body>
</html>
