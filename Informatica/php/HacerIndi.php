<?php
date_default_timezone_set('America/Mexico_City');
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener el ID
$ID = $_POST["id"] ?? '';

// 2. Obtener los datos del formulario
$Claveregis = $_POST["Claveregis"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Periodo = $_POST["Periodo"] ?? '';
$SolicitudesAtendidas = $_POST["SolicitudesAtendidas"] ?? '';
$NumSolicitudes = $_POST["NumSolicitudes"] ?? '';
$PorSolicitudesAtendidas = $_POST["PorSolicitudesAtendidas"] ?? '';
$EventualidadesMes = $_POST["EventualidadesMes"] ?? '';
$MetaEsperadaMB = $_POST["MetaEsperadaMB"] ?? '';
$RangoAceptMB = $_POST["RangoAceptMB"] ?? '';
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"] ?? '';
$Responsable = $_POST["Responsable"] ?? '';
$Fuente = $_POST["Fuente"] ?? '';

// --- Lógica de Firma ---
$firma_usuario = null;
$fecha_firma = null;
$firma_realizada = false;

if (isset($_POST['firmar_documento']) && $_POST['firmar_documento'] == 'on') {
    $clave_firma = $_POST['clave_firma'] ?? '';
    
    // Conexión a DB Usuarios
    $link_usuario = new mysqli("localhost", "root", "", "usuario");
    if ($link_usuario->connect_error) {
        die("Error conexión usuarios: " . $link_usuario->connect_error);
    }
    
    $stmt_verificar = $link_usuario->prepare("SELECT correo FROM users WHERE claveF = ? LIMIT 1");
    $stmt_verificar->bind_param("s", $clave_firma);
    $stmt_verificar->execute();
    $result_verificar = $stmt_verificar->get_result();
    
    if ($row_user = $result_verificar->fetch_assoc()) {
        $firma_usuario = $row_user['correo'];
        $fecha_firma = date('Y-m-d H:i:s');
        $firma_realizada = true;
    } else {
        echo "<script>alert('Clave incorrecta'); window.history.back();</script>";
        exit;
    }
    $stmt_verificar->close();
    $link_usuario->close();
}

// Preparar la consulta de actualización
if ($firma_realizada) {
    // Si se firmó, incluir los campos de firma en la consulta
    $query = "UPDATE i_indicador SET
                Claveregis = '$Claveregis',
                Mes = '$Mes',
                Periodo = '$Periodo',
                SolicitudesAtendidas = '$SolicitudesAtendidas',
                NumSolicitudes = '$NumSolicitudes',
                PorSolicitudesAtendidas = '$PorSolicitudesAtendidas',
                EventualidadesMes = '$EventualidadesMes',
                MetaEsperadaMB = '$MetaEsperadaMB',
                RangoAceptMB = '$RangoAceptMB',
                TendenciaDeseadaMB = '$TendenciaDeseadaMB',
                Responsable = '$Responsable',
                Fuente = '$Fuente',
                firma_usuario = '$firma_usuario',
                fecha_firma = '$fecha_firma'
            WHERE id = '$ID'";
} else {
    // Si no se firma, solo se actualizan los demás campos
    $query = "UPDATE i_indicador SET
                Claveregis = '$Claveregis',
                Mes = '$Mes',
                Periodo = '$Periodo',
                SolicitudesAtendidas = '$SolicitudesAtendidas',
                NumSolicitudes = '$NumSolicitudes',
                PorSolicitudesAtendidas = '$PorSolicitudesAtendidas',
                EventualidadesMes = '$EventualidadesMes',
                MetaEsperadaMB = '$MetaEsperadaMB',
                RangoAceptMB = '$RangoAceptMB',
                TendenciaDeseadaMB = '$TendenciaDeseadaMB',
                Responsable = '$Responsable',
                Fuente = '$Fuente'
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
    <title>Registro de Indicadores Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            if ($result) {
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
            include "Cerrar.php"; 
        ?>
        <a href="ModIndi.php" class="btn">Regresar a Modificar Indicadores</a><br>
        <br><a href='InformaticaP.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>