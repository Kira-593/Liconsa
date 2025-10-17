<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación de Formulario FM
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Cantidad_insumos = $_POST["Cantidad_insumos"] ?? '';
$ProductosT = $_POST["ProductosT"] ?? '';
$ControlesD = $_POST["ControlesD"] ?? '';
$MaterialesA = $_POST["MaterialesA"] ?? '';
$Total = $_POST["Total"] ?? '';


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Indicador_e = mysqli_real_escape_string($link, $Indicador);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$Cantidad_insumos_e = mysqli_real_escape_string($link, $Cantidad_insumos);
$ProductosT_e = mysqli_real_escape_string($link, $ProductosT);
$ControlesD_e = mysqli_real_escape_string($link, $ControlesD);
$MaterialesA_e = mysqli_real_escape_string($link, $MaterialesA);
$Total_e = mysqli_real_escape_string($link, $Total);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_formulariofm'
$query = "UPDATE c_formulariofm SET
            Indicador='$Indicador_e', 
            Mes='$Mes_e', 
            Cantidad_insumos='$Cantidad_insumos_e', 
            ProductosT='$ProductosT_e', 
            ControlesD='$ControlesD_e', 
            MaterialesA='$MaterialesA_e', 
            Total='$Total_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Formulario FM Actualizado</title>
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
                // Mensaje actualizado para Formulario FM
                echo "<div class='mensaje correcto'>Actualización del Formulario FM correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro del Formulario FM.</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Formulario FM -->
        <!-- Se asume que 'ModFormularioFM.php' es la página para modificar otros registros -->
        <a href="ModFM.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Formulario FM</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
