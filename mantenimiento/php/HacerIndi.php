<?php
date_default_timezone_set('America/Mexico_City');
session_start();

// Incluye la conexión a la base de datos
include "Conexion.php";


// Verificar si es administrador
$es_admin = isset($_SESSION['departamento']) && $_SESSION['departamento'] === 'ADMIN';

// Procesar acción de deshacer firma (solo admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'undo_signature') {
    if (!$es_admin) {
        echo "<script>alert('No tienes permisos para deshacer firmas.'); window.history.back();</script>";
        exit();
    }
    
    $ID = intval($_POST['id'] ?? 0);
    if ($ID <= 0) {
        echo "<script>alert('ID inválido.'); window.history.back();</script>";
        exit();
    }
    
    // Actualizar registro para limpiar datos de firma
    $update_query = "UPDATE m_indicador SET firma_usuario = '', fecha_firma = NULL = '' WHERE id = $ID";
    
    if (mysqli_query($link, $update_query)) {
        echo "<script>alert('Firma deshacha correctamente. El formulario está listo para editar.'); window.location.href = 'actualizarIndi.php?id=$ID';</script>";
    } else {
        echo "<script>alert('Error al deshacer firma: " . addslashes(mysqli_error($link)) . "'); window.history.back();</script>";
    }
    exit();
}

// 1. Obtener todos los datos del formulario (Mantenimiento)
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE

// Datos básicos
$Claveregis = $_POST["Claveregis"] ?? '';
$FechaAct = $_POST["FechaAct"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Periodo = $_POST["Periodo"] ?? '';

// Gastos de Operación
$PresEje = $_POST["PresEje"] ?? '';
$GastoAutorizado = $_POST["GastoAutorizado"] ?? '';
$Diferiencia = $_POST["Diferiencia"] ?? '';
$MetaEsperadaGO = $_POST["MetaEsperadaGO"] ?? '';
$RangoAceptGO = $_POST["RangoAceptGO"] ?? '';
$TendenciaDeseadaGO = $_POST["TendenciaDeseadaGO"] ?? '';

// Disponibilidad de Equipo
$HorasHombre = $_POST["HorasHombre"] ?? '';
$HorasParo = $_POST["HorasParo"] ?? '';
$HorasDisponibles = $_POST["HorasDisponibles"] ?? '';
$prc = $_POST["prc"] ?? '';
$HorasHombreEnv = $_POST["HorasHombreEnv"] ?? '';
$HorasParoEnv = $_POST["HorasParoEnv"] ?? '';
$HorasDisponiblesEnv = $_POST["HorasDisponiblesEnv"] ?? '';
$prcEnv = $_POST["prcEnv"] ?? '';
$HorasHombreReh = $_POST["HorasHombreReh"] ?? '';
$HorasParoReh = $_POST["HorasParoReh"] ?? '';
$HorasDisponiblesReh = $_POST["HorasDisponiblesReh"] ?? '';
$prcReh = $_POST["prcReh"] ?? '';
$MetaEsperadaDEP = $_POST["MetaEsperadaDEP"] ?? '';
$RangoAceptDEP = $_POST["RangoAceptDEP"] ?? '';
$TendenciaDeseadaDEP = $_POST["TendenciaDeseadaDEP"] ?? '';

// Trabajos Preventivos
$TPE = $_POST["TPE"] ?? '';
$TP = $_POST["TP"] ?? '';
$PorcentTP = $_POST["PorcentTP"] ?? '';
$MetaEsperadaTP = $_POST["MetaEsperadaTP"] ?? '';
$RangoAceptTP = $_POST["RangoAceptTP"] ?? '';
$TendenciaDeseadaTP = $_POST["TendenciaDeseadaTP"] ?? '';

// Trabajos Correctivos
$TC = $_POST["TC"] ?? '';
$PorcentTC = $_POST["PorcentTC"] ?? '';
$MetaEsperadaTC = $_POST["MetaEsperadaTC"] ?? '';
$RangoAceptTC = $_POST["RangoAceptTC"] ?? '';
$TendenciaDeseadaTC = $_POST["TendenciaDeseadaTC"] ?? '';

// Consumo Térmico
$ConsumoTermico = $_POST["ConsumoTermico"] ?? '';
$LitrosLecheProducidatermica = $_POST["LitrosLecheProducidatermica"] ?? '';
$ConsTT = $_POST["ConsTT"] ?? '';
$MetaEsperadaCT = $_POST["MetaEsperadaCT"] ?? '';
$RangoAceptCT = $_POST["RangoAceptCT"] ?? '';
$TendenciaDeseadaCT = $_POST["TendenciaDeseadaCT"] ?? '';

// Consumo de Agua
$ConsumoAgua = $_POST["ConsumoAgua"] ?? '';
$LitrosLecheProducida = $_POST["LitrosLecheProducida"] ?? '';
$ConsTA = $_POST["ConsTA"] ?? '';
$MetaEsperadaCA = $_POST["MetaEsperadaCA"] ?? '';
$RangoAceptCA = $_POST["RangoAceptCA"] ?? '';
$TendenciaDeseadaCA = $_POST["TendenciaDeseadaCA"] ?? '';

// Consumo Eléctrico
$ConsumoElectrico = $_POST["ConsumoElectrico"] ?? '';
$LitrosLecheProducidaElectrico = $_POST["LitrosLecheProducidaElectrico"] ?? '';
$ConsTE = $_POST["ConsTE"] ?? '';
$MetaEsperadaCE = $_POST["MetaEsperadaCE"] ?? '';
$RangoAceptCE = $_POST["RangoAceptCE"] ?? '';
$TendenciaDeseadaCE = $_POST["TendenciaDeseadaCE"] ?? '';

// Responsable y fuente
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

// Preparar la consulta según si hay firma o no
if ($firma_realizada) {
    // Consulta preparada CON firma
    $query = "UPDATE m_indicador SET 
                Claveregis = ?, 
                FechaAct = ?, 
                Mes = ?, 
                Periodo = ?,
                PresEje = ?, 
                GastoAutorizado = ?, 
                Diferiencia = ?, 
                MetaEsperadaGO = ?, 
                RangoAceptGO = ?, 
                TendenciaDeseadaGO = ?,
                HorasHombre = ?, 
                HorasParo = ?, 
                HorasDisponibles = ?, 
                prc = ?,
                HorasHombreEnv = ?,
                HorasParoEnv = ?,
                HorasDisponiblesEnv = ?,
                prcEnv = ?,
                HorasHombreReh = ?, 
                HorasParoReh = ?, 
                HorasDisponiblesReh = ?, 
                prcReh = ?,
                MetaEsperadaDEP = ?, 
                RangoAceptDEP = ?, 
                TendenciaDeseadaDEP = ?,
                TPE = ?, 
                TP = ?, 
                PorcentTP = ?, 
                MetaEsperadaTP = ?, 
                RangoAceptTP = ?, 
                TendenciaDeseadaTP = ?,
                TC = ?, 
                PorcentTC = ?, 
                MetaEsperadaTC = ?, 
                RangoAceptTC = ?, 
                TendenciaDeseadaTC = ?,
                ConsumoTermico = ?, 
                LitrosLecheProducidatermica = ?, 
                ConsTT = ?, 
                MetaEsperadaCT = ?, 
                RangoAceptCT = ?, 
                TendenciaDeseadaCT = ?,
                ConsumoAgua = ?, 
                LitrosLecheProducida = ?, 
                ConsTA = ?, 
                MetaEsperadaCA = ?, 
                RangoAceptCA = ?, 
                TendenciaDeseadaCA = ?,
                ConsumoElectrico = ?, 
                LitrosLecheProducidaElectrico = ?, 
                ConsTE = ?, 
                MetaEsperadaCE = ?, 
                RangoAceptCE = ?, 
                TendenciaDeseadaCE = ?,
                Responsable = ?, 
                Fuente = ?,
                firma_usuario = ?, 
                fecha_firma = ?
              WHERE id = ?";
} else {
    // Consulta preparada SIN firma
    $query = "UPDATE m_indicador SET 
                Claveregis = ?, 
                FechaAct = ?,
                Mes = ?, 
                Periodo = ?,
                PresEje = ?, 
                GastoAutorizado = ?, 
                Diferiencia = ?, 
                MetaEsperadaGO = ?, 
                RangoAceptGO = ?, 
                TendenciaDeseadaGO = ?,
                HorasHombre = ?, 
                HorasParo = ?, 
                HorasDisponibles = ?, 
                prc = ?, 
                HorasHombreEnv = ?,
                HorasParoEnv = ?,
                HorasDisponiblesEnv = ?,
                prcEnv = ?,
                HorasHombreReh = ?, 
                HorasParoReh = ?, 
                HorasDisponiblesReh = ?, 
                prcReh = ?,
                MetaEsperadaDEP = ?, 
                RangoAceptDEP = ?, 
                TendenciaDeseadaDEP = ?,
                TPE = ?, 
                TP = ?, 
                PorcentTP = ?, 
                MetaEsperadaTP = ?, 
                RangoAceptTP = ?, 
                TendenciaDeseadaTP = ?,
                TC = ?, 
                PorcentTC = ?, 
                MetaEsperadaTC = ?, 
                RangoAceptTC = ?, 
                TendenciaDeseadaTC = ?,
                ConsumoTermico = ?, 
                LitrosLecheProducidatermica = ?, 
                ConsTT = ?, 
                MetaEsperadaCT = ?, 
                RangoAceptCT = ?, 
                TendenciaDeseadaCT = ?,
                ConsumoAgua = ?, 
                LitrosLecheProducida = ?, 
                ConsTA = ?, 
                MetaEsperadaCA = ?, 
                RangoAceptCA = ?, 
                TendenciaDeseadaCA = ?,
                ConsumoElectrico = ?, 
                LitrosLecheProducidaElectrico = ?, 
                ConsTE = ?, 
                MetaEsperadaCE = ?, 
                RangoAceptCE = ?, 
                TendenciaDeseadaCE = ?,
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

if ($firma_realizada) {
    // Con firma: 49 parámetros + 2 de firma + ID = 52 en total
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
        $Claveregis, $FechaAct, $Mes, $Periodo,
        $PresEje, $GastoAutorizado, $Diferiencia, $MetaEsperadaGO, $RangoAceptGO, $TendenciaDeseadaGO,
        $HorasHombre, $HorasParo, $HorasDisponibles, $prc, $HorasHombreEnv, $HorasParoEnv, $HorasDisponiblesEnv, $prcEnv,$HorasHombreReh, $HorasParoReh, $HorasDisponiblesReh, $prcReh,
        $MetaEsperadaDEP, $RangoAceptDEP, $TendenciaDeseadaDEP,
        $TPE, $TP, $PorcentTP, $MetaEsperadaTP, $RangoAceptTP, $TendenciaDeseadaTP,
        $TC, $PorcentTC, $MetaEsperadaTC, $RangoAceptTC, $TendenciaDeseadaTC,
        $ConsumoTermico, $LitrosLecheProducidatermica, $ConsTT, $MetaEsperadaCT, $RangoAceptCT, $TendenciaDeseadaCT,
        $ConsumoAgua, $LitrosLecheProducida, $ConsTA, $MetaEsperadaCA, $RangoAceptCA, $TendenciaDeseadaCA,
        $ConsumoElectrico, $LitrosLecheProducidaElectrico, $ConsTE, $MetaEsperadaCE, $RangoAceptCE, $TendenciaDeseadaCE,
        $Responsable, $Fuente,
        $firma_usuario, $fecha_firma,
        $ID
    );
} else {
    // Sin firma: 49 parámetros + ID = 50 en total
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
        $Claveregis, $FechaAct, $Mes, $Periodo,
        $PresEje, $GastoAutorizado, $Diferiencia, $MetaEsperadaGO, $RangoAceptGO, $TendenciaDeseadaGO,
        $HorasHombre, $HorasParo, $HorasDisponibles, $prc, $HorasHombreEnv, $HorasParoEnv, $HorasDisponiblesEnv, $prcEnv,$HorasHombreReh, $HorasParoReh, $HorasDisponiblesReh, $prcReh,
        $MetaEsperadaDEP, $RangoAceptDEP, $TendenciaDeseadaDEP,
        $TPE, $TP, $PorcentTP, $MetaEsperadaTP, $RangoAceptTP, $TendenciaDeseadaTP,
        $TC, $PorcentTC, $MetaEsperadaTC, $RangoAceptTC, $TendenciaDeseadaTC,
        $ConsumoTermico, $LitrosLecheProducidatermica, $ConsTT, $MetaEsperadaCT, $RangoAceptCT, $TendenciaDeseadaCT,
        $ConsumoAgua, $LitrosLecheProducida, $ConsTA, $MetaEsperadaCA, $RangoAceptCA, $TendenciaDeseadaCA,
        $ConsumoElectrico, $LitrosLecheProducidaElectrico, $ConsTE, $MetaEsperadaCE, $RangoAceptCE, $TendenciaDeseadaCE,
        $Responsable, $Fuente,
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
                    $mensaje = "Actualización de Indicadores de Mantenimiento correcta";
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
        <!-- Enlaces de navegación actualizados para el contexto de Mantenimiento -->
        <a href="ModIndi.php" class="btn">Regresar a Actualizar Otro Indicador</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Inicio'></a>
    </div>
</body>
</html>