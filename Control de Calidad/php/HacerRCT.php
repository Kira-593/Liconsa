<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Modificación de Captación de Leche
// Usamos el operador de fusión de null (??) para asegurar que las variables existan.
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Proveedor = $_POST["Proveedor"] ?? '';
$Folio = $_POST["Folio"] ?? '';
$FechaDictamen = $_POST["FechaDictamen"] ?? '';
$Remision = $_POST["Remision"] ?? '';
$Densidad = $_POST["Densidad"] ?? '';
$Volumen = $_POST["Volumen"] ?? '';
$Grasa = $_POST["Grasa"] ?? '';
$SNG = $_POST["SNG"] ?? '';
$Proteina = $_POST["Proteina"] ?? '';
$Caseina = $_POST["Caseina"] ?? '';
$Acidez = $_POST["Acidez"] ?? '';
$Temperatura = $_POST["Temperatura"] ?? '';
$PH = $_POST["PH"] ?? '';
$Reductasa = $_POST["Reductasa"] ?? '';


// ************** INICIO DE MITIGACIÓN SQL INJECTION ******************
// Se recomienda ENCARECIDAMENTE usar sentencias preparadas en producción.
// Usamos mysqli_real_escape_string para mitigar la vulnerabilidad en este ejemplo.
$ID_e = mysqli_real_escape_string($link, $ID);
$Proveedor_e = mysqli_real_escape_string($link, $Proveedor);
$Folio_e = mysqli_real_escape_string($link, $Folio);
$FechaDictamen_e = mysqli_real_escape_string($link, $FechaDictamen);
$Remision_e = mysqli_real_escape_string($link, $Remision);
$Densidad_e = mysqli_real_escape_string($link, $Densidad);
$Volumen_e = mysqli_real_escape_string($link, $Volumen);
$Grasa_e = mysqli_real_escape_string($link, $Grasa);
$SNG_e = mysqli_real_escape_string($link, $SNG);
$Proteina_e = mysqli_real_escape_string($link, $Proteina);
$Caseina_e = mysqli_real_escape_string($link, $Caseina);
$Acidez_e = mysqli_real_escape_string($link, $Acidez);
$Temperatura_e = mysqli_real_escape_string($link, $Temperatura);
$PH_e = mysqli_real_escape_string($link, $PH);
$Reductasa_e = mysqli_real_escape_string($link, $Reductasa);
// ************** FIN DE MITIGACIÓN SQL INJECTION ******************


// 2. Consulta para actualizar los datos en la tabla 'c_captacionleche'
$query = "UPDATE c_captacionleche SET
            Proveedor='$Proveedor_e', 
            Folio='$Folio_e', 
            FechaDictamen='$FechaDictamen_e', 
            Remision='$Remision_e', 
            Densidad='$Densidad_e', 
            Volumen='$Volumen_e', 
            Grasa='$Grasa_e', 
            SNG='$SNG_e', 
            Proteina='$Proteina_e', 
            Caseina='$Caseina_e', 
            Acidez='$Acidez_e', 
            Temperatura='$Temperatura_e', 
            PH='$PH_e', 
            Reductasa='$Reductasa_e'
          WHERE id='$ID_e'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Captación de Leche Actualizado</title>
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
                // Mensaje actualizado para Captación de Leche
                echo "<div class='mensaje correcto'>Actualización del registro de Captación de Leche (ID: $ID_e) correcta</div>";
            } else {
                 // Si no hubo filas afectadas, se revisa si hubo un error de SQL
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro de Captación de Leche (ID: $ID_e).</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Enlaces de navegación actualizados para el contexto de Captación de Leche -->
        <!-- Asumimos que la página para modificar otros registros es ModRCT.php -->
        <a href="ModRCT.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Registro de Captación de Leche</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
