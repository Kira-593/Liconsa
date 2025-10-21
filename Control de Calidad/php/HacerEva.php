<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación de Evaluación de Desempeño
// Usamos el operador de fusión de null (??) para asegurar que las variables existan.
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';
$ServiciosSTS = $_POST["ServiciosSTS"] ?? '';
$ServiciosATS = $_POST["ServiciosATS"] ?? '';
$PorcentajeCTP = $_POST["PorcentajeCTP"] ?? '';
$MetaTM = $_POST["MetaTM"] ?? '';


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$ServiciosSTS_e = mysqli_real_escape_string($link, $ServiciosSTS);
$ServiciosATS_e = mysqli_real_escape_string($link, $ServiciosATS);
$PorcentajeCTP_e = mysqli_real_escape_string($link, $PorcentajeCTP);
$MetaTM_e = mysqli_real_escape_string($link, $MetaTM);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_evaluaciondesempeno'
$query = "UPDATE c_evaluaciondesempeno SET
            Mes='$Mes_e', 
            ServiciosSTS='$ServiciosSTS_e', 
            ServiciosATS='$ServiciosATS_e', 
            PorcentajeCTP='$PorcentajeCTP_e', 
            MetaTM='$MetaTM_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Evaluación de Desempeño Actualizado</title>
    <!-- Incluye Bootstrap para el estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css (asumido) para el mensaje de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                // Mensaje actualizado para Evaluación de Desempeño
                echo "<div class='mensaje correcto'>Actualización del registro de Evaluación de Desempeño (ID: $ID_e) correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro de Evaluación de Desempeño (ID: $ID_e).</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Evaluación de Desempeño -->
        <!-- Se asume ModEva.php como la página para modificar otras evaluaciones -->
        <a href="./ModEvaluacion.php" class="btn btn-primary mt-3">Regresar a Modificar Otra Evaluación de Desempeño</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
