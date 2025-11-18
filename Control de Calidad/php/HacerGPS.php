<?php
date_default_timezone_set('America/Mexico_City');

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

// Procesar firma si se solicitó
$firma_usuario = null;
$fecha_firma = null;
$firma_realizada = false;
if (isset($_POST['firmar_documento']) && $_POST['firmar_documento'] == 'on') {
    $clave_firma = $_POST['clave_firma'] ?? '';
    
    // CONEXIÓN A LA BASE DE DATOS DE USUARIOS
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname_usuario = "usuario"; // Base de datos de usuarios
    
    $link_usuario = new mysqli($servername, $username, $password, $dbname_usuario);
    
    
    // Verificar conexión a la base de datos de usuarios
    if ($link_usuario->connect_error) {
        echo "<script>
            alert('Error de conexión a la base de datos de usuarios.');
            window.history.back();
        </script>";
        include "Cerrar.php";
        exit;
    }
    // Verificar la clave de firma en la base de datos de usuarios
    $query_verificar_firma = "SELECT correo, claveF FROM users WHERE claveF = ? LIMIT 1";
    $stmt_verificar = mysqli_prepare($link_usuario, $query_verificar_firma);
    
    if ($stmt_verificar) {
        mysqli_stmt_bind_param($stmt_verificar, "s", $clave_firma);
        mysqli_stmt_execute($stmt_verificar);
        $result_verificar = mysqli_stmt_get_result($stmt_verificar);
        
        if ($result_verificar && mysqli_num_rows($result_verificar) > 0) {
            $usuario_firma = mysqli_fetch_assoc($result_verificar);
            $firma_usuario = $usuario_firma['correo'];
            $fecha_firma = date('Y-m-d H:i:s');
            $firma_realizada = true;

            $query = "UPDATE c_formulariogps SET
                        Indicador= ?, 
                        Mes=?,
                        Metodo=?,
                        Muestra=?,
                        ValorR=?,
                        ValorMax=?,
                        ValorMin=?,
                        UnidadesKG=?
                    WHERE id=?"; 

 } else {
              echo "<script>
                alert('Clave de firma inválida. No se pudo firmar el documento.');
                window.history.back();
                 </script>";
                mysqli_stmt_close($stmt_verificar);
                $link_usuario->close();
                include "Cerrar.php";
                exit;
            }
            mysqli_stmt_close($stmt_verificar);
            $link_usuario->close();
    } else {
        echo "<script>
            alert('Error al verificar la firma.');
            window.history.back();
        </script>";
        $link_usuario->close();
        include "Cerrar.php";
        exit;
    }
} else {
    $query = "UPDATE c_formulariogps SET
                Indicador= ?, 
                Mes=?,
                Metodo=?,
                Muestra=?,
                ValorR=?,
                ValorMax=?,
                ValorMin=?,
                UnidadesKG=?
            WHERE id=?";
}
if ($firma_realizada) {
    // 2. Preparar la consulta SQL con firma
    $query = "UPDATE c_formulariogps SET
                Indicador= ?, 
                Mes=?,
                Metodo=?,
                Muestra=?,
                ValorR=?,
                ValorMax=?,
                ValorMin=?,
                UnidadesKG=?,
                firma_usuario=?,
                fecha_firma=?
            WHERE id=?";
} else {
    // 2. Preparar la consulta SQL sin firma
    $query = "UPDATE c_formulariogps SET
                Indicador= ?,
                Mes=?,
                Metodo=?,
                Muestra=?,
                ValorR=?,
                ValorMax=?,
                ValorMin=?,
                UnidadesKG=?
            WHERE id=?";
}
$stmt = mysqli_prepare($link, $query);
if($firma_realizada) {
    mysqli_stmt_bind_param($stmt, "sssssssssss", 
    $Indicador, 
    $Mes, 
    $Metodo, 
    $Muestra, 
    $ValorR, 
    $ValorMax, 
    $ValorMin, 
    $UnidadesKG, 
    $firma_usuario,
    $fecha_firma, 
    $ID
);
} else {
    mysqli_stmt_bind_param($stmt, "sssssssss", 
    $Indicador, 
    $Mes, 
    $Metodo, 
    $Muestra, 
    $ValorR, 
    $ValorMax, 
    $ValorMin, 
    $UnidadesKG, 
    $ID
);
}
// Ejecutar la consulta preparada
    $ejecucion_exitosa = mysqli_stmt_execute($stmt);
    $filas_afectadas = mysqli_stmt_affected_rows($stmt);
    $error_sql = mysqli_stmt_error($stmt);

    mysqli_stmt_close($stmt);
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
            // Mostrar el resultado de la operación
            if ($ejecucion_exitosa) {
                if ($filas_afectadas > 0) {
                    $mensaje = "Actualización de Indicadores correcta";
                    if ($firma_realizada) {
                        $mensaje .= " y documento firmado exitosamente por: " . $firma_usuario;
                    }
                    echo "<div class='mensaje correcto'>$mensaje</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro.</div>";
                }
            } else {
                echo "<div class='mensaje error'>Actualización incorrecta. Error: " . $error_sql . "</div>";
            }
            
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>  
        <a href="ModGPS.php" class="btn btn-primary mt-3">Regresar a Actualizar Otro Formulario</a><br>
        <!-- Se usa el enlace de regreso que se ve en el código destino -->
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
