<?php
date_default_timezone_set('America/Mexico_City');

// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los datos del formulario de Control de Calidad
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Claveregis = $_POST["Claveregis"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Periodo = $_POST["Periodo"] ?? '';

// Calibración Externa de los Equipos del Laboratorio
$NumEquiposAtendidos = $_POST["NumEquiposAtendidos"] ?? '';
$NumEquiposProgramados = $_POST["NumEquiposProgramados"] ?? '';
$CalibracionEquipos = $_POST["CalibracionEquipos"] ?? '';
$MetaEsperadaCEE = $_POST["MetaEsperadaCEE"] ?? '';
$RangoAceptCEE = $_POST["RangoAceptCEE"] ?? '';
$TendenciaDeseadaCEE = $_POST["TendenciaDeseadaCEE"] ?? '';

// Inspección de Áreas de Producción, Almacén y Control de Calidad
$NumObservaciones = $_POST["NumObservaciones"] ?? '';
$NumPuntosEvaluados = $_POST["NumPuntosEvaluados"] ?? '';
$CumplimientoPuntosEvaluados = $_POST["CumplimientoPuntosEvaluados"] ?? '';
$MetaEsperadaIAP = $_POST["MetaEsperadaIAP"] ?? '';
$RangoAceptIAP = $_POST["RangoAceptIAP"] ?? '';
$TendenciaDeseadaIAP = $_POST["TendenciaDeseadaIAP"] ?? '';

// Responsable y fuente
$Responsable = $_POST["Responsable"] ?? '';
$ObservacionesRes = $_POST["ObservacionesRes"] ?? ''; // Textarea

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
}

// Preparar la consulta de actualización
if ($firma_realizada) {
    // Si se firmó, incluir los campos de firma en la consulta
    $query = "UPDATE c_indicador SET
                Claveregis = '$Claveregis',
                Mes = '$Mes',
                Periodo = '$Periodo',
                NumEquiposAtendidos = '$NumEquiposAtendidos',
                NumEquiposProgramados = '$NumEquiposProgramados',
                CalibracionEquipos = '$CalibracionEquipos',
                MetaEsperadaCEE = '$MetaEsperadaCEE',
                RangoAceptCEE = '$RangoAceptCEE',
                TendenciaDeseadaCEE = '$TendenciaDeseadaCEE',
                NumObservaciones = '$NumObservaciones',
                NumPuntosEvaluados = '$NumPuntosEvaluados',
                CumplimientoPuntosEvaluados = '$CumplimientoPuntosEvaluados',
                MetaEsperadaIAP = '$MetaEsperadaIAP',
                RangoAceptIAP = '$RangoAceptIAP',
                TendenciaDeseadaIAP = '$TendenciaDeseadaIAP',
                Responsable = '$Responsable',
                ObservacionesRes = '$ObservacionesRes',
                firma_usuario = '$firma_usuario',
                fecha_firma = '$fecha_firma'
            WHERE id = '$ID'";
} else {
    // Si no se firma, solo se actualizan los demás campos
    $query = "UPDATE c_indicador SET
                Claveregis = '$Claveregis',
                Mes = '$Mes',
                Periodo = '$Periodo',
                NumEquiposAtendidos = '$NumEquiposAtendidos',
                NumEquiposProgramados = '$NumEquiposProgramados',
                CalibracionEquipos = '$CalibracionEquipos',
                MetaEsperadaCEE = '$MetaEsperadaCEE',
                RangoAceptCEE = '$RangoAceptCEE',
                TendenciaDeseadaCEE = '$TendenciaDeseadaCEE',
                NumObservaciones = '$NumObservaciones',
                NumPuntosEvaluados = '$NumPuntosEvaluados',
                CumplimientoPuntosEvaluados = '$CumplimientoPuntosEvaluados',
                MetaEsperadaIAP = '$MetaEsperadaIAP',
                RangoAceptIAP = '$RangoAceptIAP',
                TendenciaDeseadaIAP = '$TendenciaDeseadaIAP',
                Responsable = '$Responsable',
                ObservacionesRes = '$ObservacionesRes'
            WHERE id = '$ID'";
}

// Ejecutar la consulta
$result = mysqli_query($link, $query);
$filas_afectadas = mysqli_affected_rows($link);
$error_sql = mysqli_error($link);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Actualizado - Indicadores de Control de Calidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/hacer.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // Mostrar el resultado de la operación
            if ($result) {
                if ($filas_afectadas > 0) {
                    $mensaje = "Actualización de Indicadores";
                    if ($firma_realizada) {
                        $mensaje .= " y documento firmado exitosamente por: " . $firma_usuario;
                    }
                    echo "<div class='mensaje correcto'>$mensaje</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro.</div>";
                }
            } else {
                echo "<div class='mensaje error'>Actualización incorrecta. Error: " . htmlspecialchars($error_sql) . "</div>";
            }
            
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>  
        <!-- Enlaces de navegación actualizados -->
        <a href="ModIndi.php" class="btn">Regresar a Actualizar Otro Indicador</a><br>
        <!-- Enlace de regreso adaptado -->
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>