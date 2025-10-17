<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación del Formulario GPS
// Usamos el operador de fusión de null (??) para asegurar que las variables existan.
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Metodo = $_POST["Metodo"] ?? '';
$Muestra = $_POST["Muestra"] ?? '';
$ValorR = $_POST["ValorR"] ?? '';
$ValorMax = $_POST["ValorMax"] ?? '';
$ValorMin = $_POST["ValorMin"] ?? '';
$UnidadesKG = $_POST["UnidadesKG"] ?? '';


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Indicador_e = mysqli_real_escape_string($link, $Indicador);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$Metodo_e = mysqli_real_escape_string($link, $Metodo);
$Muestra_e = mysqli_real_escape_string($link, $Muestra);
// Los valores numéricos también se deben escapar
$ValorR_e = mysqli_real_escape_string($link, $ValorR); 
$ValorMax_e = mysqli_real_escape_string($link, $ValorMax);
$ValorMin_e = mysqli_real_escape_string($link, $ValorMin);
$UnidadesKG_e = mysqli_real_escape_string($link, $UnidadesKG);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_formulariogps'
$query = "UPDATE c_formulariogps SET
             Indicador='$Indicador_e', 
             Mes='$Mes_e', 
             Metodo='$Metodo_e', 
             Muestra='$Muestra_e', 
             ValorR='$ValorR_e', 
             ValorMax='$ValorMax_e', 
             ValorMin='$ValorMin_e', 
             UnidadesKG='$UnidadesKG_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Formulario Determinación Actualizado</title>
    <!-- Incluye Bootstrap para el estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se asume que hacer.css es el archivo de estilos de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                // Mensaje actualizado para Formulario de Determinación
                echo "<div class='mensaje correcto'>Actualización del Formulario de Determinación (ID: $ID_e) correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el Formulario de Determinación (ID: $ID_e).</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Determinación -->
        <!-- Asumimos que la página para modificar otros registros es ModificarDeterminacion.php -->
        <a href="ModGPS.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Formulario</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
