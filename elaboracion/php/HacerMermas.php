<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Mermas de Polietileno
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';

// Campos específicos de Mermas (según la estructura de la tabla e_mermas)
$Leche_FrisiaK = $_POST["Leche_FrisiaK"] ?? '';
$porcentajeTF = $_POST["porcentajeTF"] ?? '';
$Leche_Abasto = $_POST["Leche_Abasto"] ?? '';
$porcentajeTA = $_POST["porcentajeTA"] ?? '';


// 2. Consulta para actualizar los datos en la tabla 'e_mermas'
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL. 
// Se recomienda encarecidamente usar sentencias preparadas en producción.
$query = "UPDATE e_mermas SET
            Mes='$Mes', 
            Leche_FrisiaK='$Leche_FrisiaK', 
            porcentajeTF='$porcentajeTF', 
            Leche_Abasto='$Leche_Abasto', 
            porcentajeTA='$porcentajeTA'
          WHERE id='$ID'"; 

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Mermas de Polietileno Actualizado</title>
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
                // Mensaje actualizado para Mermas
                echo "<div class='mensaje correcto'>Actualización de Mermas de Polietileno correcta</div>";
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
        <!-- Enlaces de navegación actualizados para el contexto de Mermas. 
             Se asume que la página de selección de modificación es ModMermas.php -->
        <a href="ModMermas.php" class="btn">Regresar a Actualizar Otro Formulario de Mermas</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Inicio'></a>
    </div>
</body>
</html>