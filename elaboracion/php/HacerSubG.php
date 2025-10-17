<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Subgerencia de Operaciones
// El operador ?? '' asegura que la variable siempre tenga un valor (cadena vacía si no se envía)
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE

// Campos de la tabla e_subgerencia_operaciones
$Mes = $_POST["Mes"] ?? ''; 
$LitrosFres = $_POST["LitrosFres"] ?? ''; 
$SHp = $_POST["SHp"] ?? ''; 
$SNGp = $_POST["SNGp"] ?? ''; 
$volumenTA = $_POST["volumenTA"] ?? ''; 
$solidosTA = $_POST["solidosTA"] ?? ''; 
$VolumenTC = $_POST["VolumenTC"] ?? ''; 
$TotalTC = $_POST["TotalTC"] ?? ''; 
$VolumenTP = $_POST["VolumenTP"] ?? ''; 
$LecheTP = $_POST["LecheTP"] ?? ''; 
$PorsentajeTP = $_POST["PorsentajeTP"] ?? ''; 
$ProduccionTP = $_POST["ProduccionTP"] ?? ''; 
$ContenidoTC = $_POST["ContenidoTC"] ?? ''; 
$DiasOTD = $_POST["DiasOTD"] ?? ''; 
$CapacidadITC = $_POST["CapacidadITC"] ?? ''; 
$TotalCapacidad = $_POST["TotalCapacidad"] ?? ''; 
$ProduccionATP = $_POST["ProduccionATP"] ?? ''; 
$ProduccionFTP = $_POST["ProduccionFTP"] ?? ''; 
$TotalProduccion = $_POST["TotalProduccion"] ?? ''; 
$DiasATD = $_POST["DiasATD"] ?? ''; 
$HidroxidoTH = $_POST["HidroxidoTH"] ?? ''; 
$TotalATT_Hidroxido = $_POST["TotalATT_Hidroxido"] ?? ''; 
$AcumuladoCTA_Hidroxido = $_POST["AcumuladoCTA_Hidroxido"] ?? ''; 
$AcidoFTA = $_POST["AcidoFTA"] ?? ''; 
$TotalATT_Acido = $_POST["TotalATT_Acido"] ?? ''; 
$AcumuladoCTA_Acido = $_POST["AcumuladoCTA_Acido"] ?? ''; 


// 2. Consulta preparada para actualizar los datos en la tabla 'e_subgerencia_operaciones'
// Usamos sentencias preparadas para prevenir Inyección SQL.
$query = "UPDATE e_subgerencia_operaciones SET
    Mes=?, 
    LitrosFres=?, 
    SHp=?, 
    SNGp=?, 
    volumenTA=?, 
    solidosTA=?, 
    VolumenTC=?, 
    TotalTC=?, 
    VolumenTP=?, 
    LecheTP=?, 
    PorsentajeTP=?, 
    ProduccionTP=?, 
    ContenidoTC=?, 
    DiasOTD=?, 
    CapacidadITC=?, 
    TotalCapacidad=?, 
    ProduccionATP=?, 
    ProduccionFTP=?, 
    TotalProduccion=?, 
    DiasATD=?, 
    HidroxidoTH=?, 
    TotalATT_Hidroxido=?, 
    AcumuladoCTA_Hidroxido=?, 
    AcidoFTA=?, 
    TotalATT_Acido=?, 
    AcumuladoCTA_Acido=?
    WHERE id=?";

// 3. Preparar y ejecutar la consulta
// Se utiliza 's' (string) para todos los campos para simplificar el manejo de tipos, 
// lo cual es seguro en sentencias preparadas.
$stmt = mysqli_prepare($link, $query);

// Cadena de tipos: 26 campos de actualización + 1 campo WHERE (id)
// Usamos 's' (string) para todos, aunque muchos sean números. MySQLi los manejará.
$types = str_repeat('s', 27); 

// Array de variables para el binding
$params = [
    $Mes, $LitrosFres, $SHp, $SNGp, $volumenTA, $solidosTA, $VolumenTC, 
    $TotalTC, $VolumenTP, $LecheTP, $PorsentajeTP, $ProduccionTP, $ContenidoTC, 
    $DiasOTD, $CapacidadITC, $TotalCapacidad, $ProduccionATP, $ProduccionFTP, 
    $TotalProduccion, $DiasATD, $HidroxidoTH, $TotalATT_Hidroxido, $AcumuladoCTA_Hidroxido, 
    $AcidoFTA, $TotalATT_Acido, $AcumuladoCTA_Acido, $ID
];

// Se usa call_user_func_array para enlazar dinámicamente los parámetros
mysqli_stmt_bind_param($stmt, $types, ...$params);

// Ejecutar el statement
$ejecutado = mysqli_stmt_execute($stmt);

// Obtener el número de filas afectadas ANTES de cerrar el statement
$filas_afectadas = $ejecutado ? mysqli_stmt_affected_rows($stmt) : 0;
$error_stmt = mysqli_stmt_error($stmt); // Capturar error si lo hay

// 4. Cerrar el statement
mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Subgerencia de Operaciones Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Se actualiza el CSS al contexto de Subgerencia (asumiendo que hacer.css es el general de resultados) -->
    <!-- Se usará el CSS general para el mensaje de resultado (asumiendo que existe) -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 5. Mostrar el resultado de la operación
            if ($ejecutado && $filas_afectadas > 0) {
                // Mensaje actualizado para Subgerencia de Operaciones
                echo "<div class='mensaje correcto'>Actualización de Subgerencia de Operaciones correcta</div>";
            } elseif ($ejecutado && $filas_afectadas === 0) {
                // Si la ejecución fue exitosa pero no hubo filas afectadas (no hubo cambios)
                echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro.</div>";
            } else {
                // Si hubo un error en la ejecución
                $error_msg = $error_stmt ? $error_stmt : (mysqli_error($link) ?: "Error desconocido.");
                echo "<div class='mensaje error'>Actualización incorrecta. Error: " . htmlspecialchars($error_msg) . "</div>";
            }
            
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- El enlace de regreso apunta a la página que permite seleccionar otro registro de Subgerencia para modificar. 
             Se asume que la página de selección es ModSubG.php (similar a ModEnvases.php) -->
        <a href="ModSubG.php" class="btn">Regresar a Actualizar Otro Formulario</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Inicio'></a>
    </div>
</body>
</html>
