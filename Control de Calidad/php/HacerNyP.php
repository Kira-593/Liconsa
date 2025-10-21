<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación de Contenido Neto y Peso
// Usamos el operador de fusión de null (??) para asegurar que las variables existan.
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$MinimoTMN = $_POST["MinimoTMN"] ?? '';
$MaximoTMN = $_POST["MaximoTMN"] ?? '';
$PromedioTPN = $_POST["PromedioTPN"] ?? '';
$MinimoTE = $_POST["MinimoTE"] ?? '';
$MaximoTE = $_POST["MaximoTE"] ?? '';
$PromedioTP = $_POST["PromedioTP"] ?? '';


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Indicador_e = mysqli_real_escape_string($link, $Indicador);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$MinimoTMN_e = mysqli_real_escape_string($link, $MinimoTMN);
$MaximoTMN_e = mysqli_real_escape_string($link, $MaximoTMN);
$PromedioTPN_e = mysqli_real_escape_string($link, $PromedioTPN);
$MinimoTE_e = mysqli_real_escape_string($link, $MinimoTE);
$MaximoTE_e = mysqli_real_escape_string($link, $MaximoTE);
$PromedioTP_e = mysqli_real_escape_string($link, $PromedioTP);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_contenidonetopesoenvase'
$query = "UPDATE c_contenidonetopesoenvase SET
            Indicador='$Indicador_e', 
            Mes='$Mes_e', 
            MinimoTMN='$MinimoTMN_e', 
            MaximoTMN='$MaximoTMN_e', 
            PromedioTPN='$PromedioTPN_e', 
            MinimoTE='$MinimoTE_e', 
            MaximoTE='$MaximoTE_e', 
            PromedioTP='$PromedioTP_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<ht lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Contenido Neto y Peso de Envase Vacío Actualizado</title>
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
                // Mensaje actualizado para Contenido Neto y Peso
                echo "<div class='mensaje correcto'>Actualización del registro de Contenido Neto y Peso de Envase Vacío (ID: $ID_e) correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    // Mensaje actualizado para Contenido Neto y Peso (sin cambios)
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro de Contenido Neto y Peso de Envase Vacío (ID: $ID_e).</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Contenido Neto y Peso -->
        <!-- Asumimos un script de modificación para este contexto, por ejemplo: ModNyP.php -->
        <a href="./ModContenidoNyP.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Registro de Contenido Neto y Peso</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>