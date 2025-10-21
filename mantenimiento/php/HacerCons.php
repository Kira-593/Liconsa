<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener todos los datos del formulario (Consumo de Energía y Producción)
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';
$ProduccionLecheTP = $_POST["ProduccionLecheTP"] ?? '';
$ReduccionITR_Leche = $_POST["ReduccionITR_Leche"] ?? '';
$EnergiaElectricaTE = $_POST["EnergiaElectricaTE"] ?? '';
$EnergiaElectricaTEG = $_POST["EnergiaElectricaTEG"] ?? '';
$ReduccionITR_Energia = $_POST["ReduccionITR_Energia"] ?? '';
$ConsumoDieselTP = $_POST["ConsumoDieselTP"] ?? '';
$ConsumoDieselTPG = $_POST["ConsumoDieselTPG"] ?? '';
$ReduccionITR_Diesel = $_POST["ReduccionITR_Diesel"] ?? '';


// 2. Consulta para actualizar los datos en la tabla 'm_consumo_energia_produccion'
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL. 
// Se recomienda encarecidamente usar sentencias preparadas en producción.
$query = "UPDATE m_consumo_energia_produccion SET
            Mes='$Mes', 
            ProduccionLecheTP='$ProduccionLecheTP', 
            ReduccionITR_Leche='$ReduccionITR_Leche', 
            EnergiaElectricaTE='$EnergiaElectricaTE',
            EnergiaElectricaTEG='$EnergiaElectricaTEG',
            ReduccionITR_Energia='$ReduccionITR_Energia',
            ConsumoDieselTP='$ConsumoDieselTP',
            ConsumoDieselTPG='$ConsumoDieselTPG',
            ReduccionITR_Diesel='$ReduccionITR_Diesel'
          WHERE id='$ID'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            $registro_nombre = "Consumo de Energía y Producción";
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Actualización del registro de $registro_nombre correcta</div>";
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
        
        <a href="./ModCons.php" class="btn">Regresar a Modificar Consumo</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>
