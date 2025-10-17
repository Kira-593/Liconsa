<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación de Resumen de Adquisiciones
// Usamos el operador de fusión de null (??) para asegurar que las variables existan.
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';
$CodigoTC = $_POST["CodigoTC"] ?? '';
$DescripcionBTD = $_POST["DescripcionBTD"] ?? '';
$MontoSIT = $_POST["MontoSIT"] ?? ''; // Monto sin Iva
$LPAD = $_POST["LPAD"] ?? '';
$EmpresaATE = $_POST["EmpresaATE"] ?? '';
$TotalGET = $_POST["TotalGET"] ?? ''; // Total Gerencia Estatal Tlaxcala (asumido como el segundo campo numérico)


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$CodigoTC_e = mysqli_real_escape_string($link, $CodigoTC);
$DescripcionBTD_e = mysqli_real_escape_string($link, $DescripcionBTD);
$MontoSIT_e = mysqli_real_escape_string($link, $MontoSIT);
$LPAD_e = mysqli_real_escape_string($link, $LPAD);
$EmpresaATE_e = mysqli_real_escape_string($link, $EmpresaATE);
$TotalGET_e = mysqli_real_escape_string($link, $TotalGET);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_resumenadquisiciones' (asumida)
$query = "UPDATE c_resumenadquisiciones SET
            Mes='$Mes_e', 
            CodigoTC='$CodigoTC_e', 
            DescripcionBTD='$DescripcionBTD_e', 
            MontoSIT='$MontoSIT_e', 
            LPAD='$LPAD_e', 
            EmpresaATE='$EmpresaATE_e', 
            TotalGET='$TotalGET_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Resumen de Adquisiciones Actualizado</title>
    <!-- Incluye Bootstrap para el estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/hacer.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                // Mensaje actualizado para Resumen de Adquisiciones
                echo "<div class='mensaje correcto'>Actualización del registro de Resumen de Adquisiciones (ID: $ID_e) correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    // Mensaje actualizado para Resumen de Adquisiciones (sin cambios)
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro de Resumen de Adquisiciones (ID: $ID_e).</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Adquisiciones -->
        <!-- Asumimos que la página para modificar otros registros es ModificarResumenA.php -->
        <a href="Modificación.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Resumen de Adquisiciones</a><br>
        <!-- El home link regresa al menú de modificación -->
        <br><a href='Adquisiciones.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
