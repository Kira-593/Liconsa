<?php
date_default_timezone_set('America/Mexico_City');
session_start();

// Incluye la conexión a la base de datos (se asume que define $link)
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
    $update_query = "UPDATE cred_depto_credito_cobranza SET firma_usuario = '', fecha_firma = NULL WHERE id = $ID";
    
    if (mysqli_query($link, $update_query)) {
        echo "<script>alert('Firma deshacha correctamente. El formulario está listo para editar.'); window.location.href = 'actualizarCredito.php?id=$ID';</script>";
    } else {
        echo "<script>alert('Error al deshacer firma: " . addslashes(mysqli_error($link)) . "'); window.history.back();</script>";
    }
    exit();
}


// --- 1. Obtener todos los datos del formulario (Depto. Crédito y Cobranza) ---
// Usamos el operador de fusión de null (??) para obtener los valores POST o una cadena vacía.
// Esto mejora la seguridad al garantizar que todas las variables estén definidas antes de usarlas.
$ID = $_POST["id"] ?? ''; 
$Mes = $_POST["Mes"] ?? '';
$CantidadLTF = $_POST["CantidadLTF"] ?? '';
$ImporteTF = $_POST["ImporteTF"] ?? '';
$PorcentajeTF = $_POST["PorcentajeTF"] ?? '';
$CantidadLTFR = $_POST["CantidadLTFR"] ?? '';
$ImporteTFR = $_POST["ImporteTFR"] ?? '';
$PorcentajeTFR = $_POST["PorcentajeTFR"] ?? '';
$CantidadLTPAS = $_POST["CantidadLTPAS"] ?? '';
$ImporteTPAS = $_POST["ImporteTPAS"] ?? '';
$PorcentajeTPAS = $_POST["PorcentajeTPAS"] ?? '';
$CantidadLTPC = $_POST["CantidadLTPC"] ?? '';
$ImporteLTPC = $_POST["ImporteLTPC"] ?? '';
$PorcentajeLTPC = $_POST["PorcentajeLTPC"] ?? '';
$CantidadLTUHT = $_POST["CantidadLTUHT"] ?? '';
$ImporteLTUHT = $_POST["ImporteLTUHT"] ?? '';
$PorcentajeLTUHT = $_POST["PorcentajeLTUHT"] ?? '';
$ObservacionesRes = $_POST["ObservacionesRes"] ?? '';
$TotalFacturadoMes = $_POST["TotalFacturadoMes"] ?? '';
$TotalDepositosMes = $_POST["TotalDepositosMes"] ?? '';
$ObservacionesFacturasDepositos = $_POST["ObservacionesFacturasDepositos"] ?? '';
$SaldoTS = $_POST["SaldoTS"] ?? '';
$SaldoPV = $_POST["SaldoPV"] ?? '';
$SaldoV = $_POST["SaldoV"] ?? '';
$Saldotreina = $_POST["Saldotreina"] ?? '';
$Saldosesenta = $_POST["Saldosesenta"] ?? '';
$Saldonoventa = $_POST["Saldonoventa"] ?? '';
$Saldosecenta = $_POST["Saldosecenta"] ?? '';
$ObservacionesSaldos = $_POST["ObservacionesSaldos"] ?? '';
$TotalSaldo = $_POST["TotalSaldo"] ?? '';
$ObservacionesSaldomes = $_POST["ObservacionesSaldomes"] ?? '';

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
// 2. Consulta de actualización utilizando marcadores de posición (?)
// Tabla asumida: 'cred_depto_credito_cobranza'
$query = "UPDATE cred_depto_credito_cobranza SET
            Mes = ?,
            CantidadLTF = ?,
            ImporteTF = ?,
            PorcentajeTF = ?,
            CantidadLTFR = ?,
            ImporteTFR = ?,
            PorcentajeTFR = ?,
            CantidadLTPAS = ?,
            ImporteTPAS = ?,
            PorcentajeTPAS = ?,
            CantidadLTPC = ?,
            ImporteLTPC = ?,
            PorcentajeLTPC = ?,
            CantidadLTUHT = ?,
            ImporteLTUHT = ?,
            PorcentajeLTUHT = ?,
            ObservacionesRes = ?,
            TotalFacturadoMes = ?,
            TotalDepositosMes = ?,
            ObservacionesFacturasDepositos = ?,
            SaldoTS = ?,
            SaldoPV = ?,
            SaldoV = ?,
            Saldotreina = ?,
            Saldosesenta = ?,
            Saldonoventa = ?,
            Saldosecenta = ?,
            ObservacionesSaldos = ?,
            TotalSaldo = ?,
            ObservacionesSaldomes = ?
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
    // Si no se firma, preparamos el UPDATE sin campos de firma
    $query = "UPDATE cred_depto_credito_cobranza SET
                Mes = ?,
                CantidadLTF = ?,
                ImporteTF = ?,
                PorcentajeTF = ?,
                CantidadLTFR = ?,
                ImporteTFR = ?,
                PorcentajeTFR = ?,
                CantidadLTPAS = ?,
                ImporteTPAS = ?,
                PorcentajeTPAS = ?,
                CantidadLTPC = ?,
                ImporteLTPC = ?,
                PorcentajeLTPC = ?,
                CantidadLTUHT = ?,
                ImporteLTUHT = ?,
                PorcentajeLTUHT = ?,
                ObservacionesRes = ?,
                TotalFacturadoMes = ?,
                TotalDepositosMes = ?,
                ObservacionesFacturasDepositos = ?,
                SaldoTS = ?,
                SaldoPV = ?,
                SaldoV = ?,
                Saldotreina = ?,
                Saldosesenta = ?,
                Saldonoventa = ?,
                Saldosecenta = ?,
                ObservacionesSaldos = ?,
                TotalSaldo = ?,
                ObservacionesSaldomes = ?
              WHERE id = ?";
}
if($firma_realizada) {
    // 2. Preparar la consulta SQL con firma
    $query = "UPDATE cred_depto_credito_cobranza SET
                Mes = ?,
                CantidadLTF = ?,
                ImporteTF = ?,
                PorcentajeTF = ?,
                CantidadLTFR = ?,
                ImporteTFR = ?,
                PorcentajeTFR = ?,
                CantidadLTPAS = ?,
                ImporteTPAS = ?,
                PorcentajeTPAS = ?,
                CantidadLTPC = ?,
                ImporteLTPC = ?,
                PorcentajeLTPC = ?,
                CantidadLTUHT = ?,
                ImporteLTUHT = ?,
                PorcentajeLTUHT = ?,
                ObservacionesRes = ?,
                TotalFacturadoMes = ?,
                TotalDepositosMes = ?,
                ObservacionesFacturasDepositos = ?,
                SaldoTS = ?,
                SaldoPV = ?,
                SaldoV = ?,
                Saldotreina = ?,
                Saldosesenta = ?,
                Saldonoventa = ?,
                Saldosecenta = ?,
                ObservacionesSaldos = ?,
                TotalSaldo = ?,
                ObservacionesSaldomes = ?,
                firma_usuario = ?,
                fecha_firma = ?
              WHERE id = ?";
} else {
   $query = "UPDATE cred_depto_credito_cobranza SET
                Mes = ?,
                CantidadLTF = ?,
                ImporteTF = ?,
                PorcentajeTF = ?,
                CantidadLTFR = ?,
                ImporteTFR = ?,
                PorcentajeTFR = ?,
                CantidadLTPAS = ?,
                ImporteTPAS = ?,
                PorcentajeTPAS = ?,
                CantidadLTPC = ?,
                ImporteLTPC = ?,
                PorcentajeLTPC = ?,
                CantidadLTUHT = ?,
                ImporteLTUHT = ?,
                PorcentajeLTUHT = ?,
                ObservacionesRes = ?,
                TotalFacturadoMes = ?,
                TotalDepositosMes = ?,
                ObservacionesFacturasDepositos = ?,
                SaldoTS = ?,
                SaldoPV = ?,
                SaldoV = ?,
                Saldotreina = ?,
                Saldosesenta = ?,
                Saldonoventa = ?,
                Saldosecenta = ?,
                ObservacionesSaldos = ?,
                TotalSaldo = ?,
                ObservacionesSaldomes = ?
              WHERE id = ?";
}
$stmt = mysqli_prepare($link, $query);
if($firma_realizada) {
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssss",
    $Mes, $CantidadLTF, $ImporteTF, $PorcentajeTF,
    $CantidadLTFR, $ImporteTFR, $PorcentajeTFR,
    $CantidadLTPAS, $ImporteTPAS, $PorcentajeTPAS,
    $CantidadLTPC, $ImporteLTPC, $PorcentajeLTPC,
    $CantidadLTUHT, $ImporteLTUHT, $PorcentajeLTUHT,
    $ObservacionesRes, $TotalFacturadoMes, $TotalDepositosMes,
    $ObservacionesFacturasDepositos,
    $SaldoTS, $SaldoPV, $SaldoV, $Saldotreina, $Saldosesenta, 
    $Saldonoventa, $Saldosecenta, $ObservacionesSaldos,
    $TotalSaldo, $ObservacionesSaldomes,
    $firma_usuario,
    $fecha_firma, $ID
);
} else {
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssss",
    $Mes, $CantidadLTF, $ImporteTF, $PorcentajeTF,
    $CantidadLTFR, $ImporteTFR, $PorcentajeTFR,
    $CantidadLTPAS, $ImporteTPAS, $PorcentajeTPAS,
    $CantidadLTPC, $ImporteLTPC, $PorcentajeLTPC,
    $CantidadLTUHT, $ImporteLTUHT, $PorcentajeLTUHT,
    $ObservacionesRes, $TotalFacturadoMes, $TotalDepositosMes,
    $ObservacionesFacturasDepositos,
    $SaldoTS, $SaldoPV, $SaldoV, $Saldotreina, $Saldosesenta, 
    $Saldonoventa, $Saldosecenta, $ObservacionesSaldos,
    $TotalSaldo, $ObservacionesSaldomes,
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
    <title>Resultado de Modificación de Indicadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado (asumido) -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
   
</head>
<body>
    <div class="contenedor">
     < <?php
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
        <!-- Enlaces de navegación -->
        <a href="ModCredito.php" class="btn btn-primary">Regresar a la Modificación</a>
        <br><a href='MenuModifi.php' class="home-link"><img src='../imagenes/home.png' height='100' width='90' alt="Ir al Menú Principal"></a>
    </div>
</body>
</html>
