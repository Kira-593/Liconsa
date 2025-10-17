<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Relaciones Industriales
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Mes = $_POST["Mes"] ?? '';
$NumeroTrabajadores = $_POST["NumeroTrabajadores"] ?? '';
$TrabajadoresH = $_POST["TrabajadoresH"] ?? '';
$HombresConfianza = $_POST["HombresConfianza"] ?? '';
$HombresSindicato = $_POST["HombresSindicato"] ?? '';
$TrabajadoresM = $_POST["TrabajadoresM"] ?? '';
$MujeresConfianza = $_POST["MujeresConfianza"] ?? '';
$MujeresSindicato = $_POST["MujeresSindicato"] ?? '';
$TrabajadoresConfianza = $_POST["TrabajadoresConfianza"] ?? '';
$TrabajadoresSindicato = $_POST["TrabajadoresSindicato"] ?? '';
$NumeroPlazasOcupadas = $_POST["NumeroPlazasOcupadas"] ?? '';
$VacantesTV = $_POST["VacantesTV"] ?? ''; // Textarea
$IncapacidadesTI = $_POST["IncapacidadesTI"] ?? ''; // Textarea


// 2. Consulta para actualizar los datos en la tabla 'g_relacionesindustriales'
// ADVERTENCIA: Esta consulta es VULNERABLE a Inyección SQL. 
// Se recomienda encarecidamente usar sentencias preparadas en producción.
$query = "UPDATE g_relacionesindustriales SET
            Mes='$Mes',
            NumeroTrabajadores='$NumeroTrabajadores',
            TrabajadoresH='$TrabajadoresH',
            HombresConfianza='$HombresConfianza',
            HombresSindicato='$HombresSindicato',
            TrabajadoresM='$TrabajadoresM',
            MujeresConfianza='$MujeresConfianza',
            MujeresSindicato='$MujeresSindicato',
            TrabajadoresConfianza='$TrabajadoresConfianza',
            TrabajadoresSindicato='$TrabajadoresSindicato',
            NumeroPlazasOcupadas='$NumeroPlazasOcupadas',
            VacantesTV='$VacantesTV',
            IncapacidadesTI='$IncapacidadesTI'
          WHERE id='$ID'";

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Actualizado - Relaciones Industriales</title>
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
                // Mensaje actualizado para Relaciones Industriales
                echo "<div class='mensaje correcto'>Actualización de Relaciones Industriales correcta</div>";
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
        <!-- Enlaces de navegación actualizados para el contexto de Relaciones Industriales -->
        <a href="ModRelaciones.php" class="btn">Regresar a Menú de Modificaciones</a><br>
        <!-- Enlace de regreso adaptado para ir a GestionP.php (página principal de Gestión) -->
        <br><a href='gestionP.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>
