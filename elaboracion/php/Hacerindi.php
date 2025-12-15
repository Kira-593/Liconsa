<?php
date_default_timezone_set('America/Mexico_City');
session_start();

// Incluye la conexión a la base de datos
include "Conexion.php";

// Obtener los datos del formulario de Indicadores de Elaboración
$ID = $_POST["id"] ?? '';

// Datos básicos
$Claveregis = $_POST["Claveregis"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Periodo = $_POST["Periodo"] ?? '';

// Cumplimiento al Programa de Distribución Mensual de Leche
$DBPAS = $_POST["DBPAS"] ?? '';
$PDOACP = $_POST["PDOACP"] ?? '';
$LRAPMDOL = $_POST["LRAPMDOL"] ?? '';
$PC = $_POST["PC"] ?? '';
$MetaEsperadaDMLPS = $_POST["MetaEsperadaDMLPS"] ?? '';
$RangoAceptDMLPS = $_POST["RangoAceptDMLPS"] ?? '';
$TendenciaDeseadaDMLPS = $_POST["TendenciaDeseadaDMLPS"] ?? '';

// Entrega de Producto no Cubiertas
$CDLPAS = $_POST["CDLPAS"] ?? '';
$MetaEsperadaEPNC = $_POST["MetaEsperadaEPNC"] ?? '';
$RangoAceptEPNC = $_POST["RangoAceptEPNC"] ?? '';
$TendenciaDeseadaEPNC = $_POST["TendenciaDeseadaEPNC"] ?? '';

// Cumplimiento Con la Producción Solicitada
$DespaReal = $_POST["DespaReal"] ?? '';
$DespaProg = $_POST["DespaProg"] ?? '';
$LechePrograma = $_POST["LechePrograma"] ?? '';
$PorcentajeProduccion = $_POST["PorcentajeProduccion"] ?? '';
$PPL = $_POST["PPL"] ?? '';
$MetaEsperadaCPSP = $_POST["MetaEsperadaCPSP"] ?? '';
$RangoAceptCPSP = $_POST["RangoAceptCPSP"] ?? '';
$TendenciaDeseadaCPSP = $_POST["TendenciaDeseadaCPSP"] ?? '';

// Calidad de la leche de Abasto - Grasa
$GLCMGV = $_POST["GLCMGV"] ?? '';
$GLPD = $_POST["GLPD"] ?? '';

// Calidad de la leche de Abasto - Proteína
$PLCMGV = $_POST["PLCMGV"] ?? '';
$PLPD = $_POST["PLPD"] ?? '';
$MetaEsperadaCLA = $_POST["MetaEsperadaCLA"] ?? '';
$RangoAceptCLA = $_POST["RangoAceptCLA"] ?? '';
$TendenciaDeseadaCLA = $_POST["TendenciaDeseadaCLA"] ?? '';

// Cumplimiento de las Buenas Prácticas de Higiene
$PCBH = $_POST["PCBH"] ?? '';
$MetaEsperadaCBC = $_POST["MetaEsperadaCBC"] ?? '';
$RangoAceptCBC = $_POST["RangoAceptCBC"] ?? '';
$TendenciaDeseadaCBC = $_POST["TendenciaDeseadaCBC"] ?? '';

// Cumplimiento a los Lineamientos Internos
$PCCL = $_POST["PCCL"] ?? '';
$MetaEsperadaCLI = $_POST["MetaEsperadaCLI"] ?? '';
$RangoAceptCLI = $_POST["RangoAceptCLI"] ?? '';
$TendenciaDeseadaCLI = $_POST["TendenciaDeseadaCLI"] ?? '';

// Información adicional
$Responsable = $_POST["Responsable"] ?? '';
$Fuente = $_POST["Fuente"] ?? '';

// Procesar firma si se solicitó
$firma_usuario = null;
$fecha_firma = null;
$firma_realizada = false;

if (isset($_POST['firmar_documento']) && $_POST['firmar_documento'] == 'on') {
    $clave_firma = $_POST['clave_firma'] ?? '';
    $confirmar_clave = $_POST['confirmar_clave'] ?? '';
    
    // Verificar que las claves coincidan
    if ($clave_firma !== $confirmar_clave) {
        echo "<script>
            alert('Las claves de firma no coinciden.');
            window.history.back();
        </script>";
        exit;
    }
    
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

            // Consulta preparada CON firma
            $query = "UPDATE e_indicador SET 
                        Claveregis = ?, 
                        Mes = ?, 
                        Periodo = ?,
                        DBPAS = ?, 
                        PDOACP = ?, 
                        LRAPMDOL = ?, 
                        PC = ?, 
                        MetaEsperadaDMLPS = ?, 
                        RangoAceptDMLPS = ?, 
                        TendenciaDeseadaDMLPS = ?,
                        CDLPAS = ?, 
                        MetaEsperadaEPNC = ?, 
                        RangoAceptEPNC = ?, 
                        TendenciaDeseadaEPNC = ?,
                        DespaReal = ?, 
                        DespaProg = ?, 
                        LechePrograma = ?, 
                        PorcentajeProduccion = ?, 
                        PPL = ?, 
                        MetaEsperadaCPSP = ?, 
                        RangoAceptCPSP = ?, 
                        TendenciaDeseadaCPSP = ?,
                        GLCMGV = ?, 
                        GLPD = ?, 
                        PLCMGV = ?, 
                        PLPD = ?, 
                        MetaEsperadaCLA = ?, 
                        RangoAceptCLA = ?, 
                        TendenciaDeseadaCLA = ?,
                        PCBH = ?, 
                        MetaEsperadaCBC = ?, 
                        RangoAceptCBC = ?, 
                        TendenciaDeseadaCBC = ?,
                        PCCL = ?, 
                        MetaEsperadaCLI = ?, 
                        RangoAceptCLI = ?, 
                        TendenciaDeseadaCLI = ?,
                        Responsable = ?, 
                        Fuente = ?,
                        firma_usuario = ?, 
                        fecha_firma = ?
                      WHERE id = ?";
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
    // Consulta preparada SIN firma
    $query = "UPDATE e_indicador SET 
                Claveregis = ?, 
                Mes = ?, 
                Periodo = ?,
                DBPAS = ?, 
                PDOACP = ?, 
                LRAPMDOL = ?, 
                PC = ?, 
                MetaEsperadaDMLPS = ?, 
                RangoAceptDMLPS = ?, 
                TendenciaDeseadaDMLPS = ?,
                CDLPAS = ?, 
                MetaEsperadaEPNC = ?, 
                RangoAceptEPNC = ?, 
                TendenciaDeseadaEPNC = ?,
                DespaReal = ?, 
                DespaProg = ?, 
                LechePrograma = ?, 
                PorcentajeProduccion = ?, 
                PPL = ?, 
                MetaEsperadaCPSP = ?, 
                RangoAceptCPSP = ?, 
                TendenciaDeseadaCPSP = ?,
                GLCMGV = ?, 
                GLPD = ?, 
                PLCMGV = ?, 
                PLPD = ?, 
                MetaEsperadaCLA = ?, 
                RangoAceptCLA = ?, 
                TendenciaDeseadaCLA = ?,
                PCBH = ?, 
                MetaEsperadaCBC = ?, 
                RangoAceptCBC = ?, 
                TendenciaDeseadaCBC = ?,
                PCCL = ?, 
                MetaEsperadaCLI = ?, 
                RangoAceptCLI = ?, 
                TendenciaDeseadaCLI = ?,
                Responsable = ?, 
                Fuente = ?
              WHERE id = ?";
}

$stmt = mysqli_prepare($link, $query);

if (!$stmt) {
    echo "<script>
        alert('Error al preparar la consulta: " . mysqli_error($link) . "');
        window.history.back();
    </script>";
    include "Cerrar.php";
    exit;
}

// Para debugging: contar el número de parámetros
$param_count = mysqli_stmt_param_count($stmt);
echo "<!-- Número de parámetros esperados: $param_count -->";

if ($firma_realizada) {
    // CORRECCIÓN: Contamos 41 parámetros + ID = 42 en total
    // La cadena de tipos debe tener 42 caracteres
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssssss",
        $Claveregis, $Mes, $Periodo,
        $DBPAS, $PDOACP, $LRAPMDOL, $PC, $MetaEsperadaDMLPS, $RangoAceptDMLPS, $TendenciaDeseadaDMLPS,
        $CDLPAS, $MetaEsperadaEPNC, $RangoAceptEPNC, $TendenciaDeseadaEPNC,
        $DespaReal, $DespaProg, $LechePrograma, $PorcentajeProduccion, $PPL, $MetaEsperadaCPSP, $RangoAceptCPSP, $TendenciaDeseadaCPSP,
        $GLCMGV, $GLPD, $PLCMGV, $PLPD, $MetaEsperadaCLA, $RangoAceptCLA, $TendenciaDeseadaCLA,
        $PCBH, $MetaEsperadaCBC, $RangoAceptCBC, $TendenciaDeseadaCBC,
        $PCCL, $MetaEsperadaCLI, $RangoAceptCLI, $TendenciaDeseadaCLI,
        $Responsable, $Fuente,
        $firma_usuario, $fecha_firma,
        $ID
    );
    echo "<!-- bind_param ejecutado CON firma -->";
} else {
    // CORRECCIÓN: Contamos 39 parámetros + ID = 40 en total
    // La cadena de tipos debe tener 40 caracteres
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssss",
        $Claveregis, $Mes, $Periodo,
        $DBPAS, $PDOACP, $LRAPMDOL, $PC, $MetaEsperadaDMLPS, $RangoAceptDMLPS, $TendenciaDeseadaDMLPS,
        $CDLPAS, $MetaEsperadaEPNC, $RangoAceptEPNC, $TendenciaDeseadaEPNC,
        $DespaReal, $DespaProg, $LechePrograma, $PorcentajeProduccion, $PPL, $MetaEsperadaCPSP, $RangoAceptCPSP, $TendenciaDeseadaCPSP,
        $GLCMGV, $GLPD, $PLCMGV, $PLPD, $MetaEsperadaCLA, $RangoAceptCLA, $TendenciaDeseadaCLA,
        $PCBH, $MetaEsperadaCBC, $RangoAceptCBC, $TendenciaDeseadaCBC,
        $PCCL, $MetaEsperadaCLI, $RangoAceptCLI, $TendenciaDeseadaCLI,
        $Responsable, $Fuente,
        $ID
    );
    echo "<!-- bind_param ejecutado SIN firma -->";
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
    <title>Registro Actualizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    $mensaje = "Actualización de Indicadores de Elaboración correcta";
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
        <!-- Enlaces de navegación actualizados para el contexto de Elaboración -->
        <a href="ModIndi.php" class="btn">Regresar a Actualizar Otro Indicador</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Inicio'></a>
    </div>
</body>
</html>