<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los 5 datos del formulario (Factor de Retiro)
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$FactorRTF = $_POST["FactorRTF"] ?? '';
$AlcanceTA = $_POST["AlcanceTA"] ?? '';


// 2. Consulta para actualizar los datos en la tabla 'p_factorretiro'
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL. 
// Se recomienda encarecidamente usar sentencias preparadas en producción.
$query = "UPDATE p_factorretiro SET
            Indicador='$Indicador', 
            Mes='$Mes', 
            FactorRTF='$FactorRTF', 
            AlcanceTA='$AlcanceTA'
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
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Actualización del Factor de Retiro correcta</div>";
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
        <!-- Enlaces de navegación actualizados para el contexto de Factor de Retiro -->
         <a href="./ModFactor.php" class="btn">Regresar a Actualizar Otro Formulario</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>