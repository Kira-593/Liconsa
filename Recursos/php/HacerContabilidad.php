<?php
date_default_timezone_set('America/Mexico_City');

include "Conexion.php";

// Definición de $ID para ser usado en el WHERE
$ID = $_POST["id"] ?? ''; 
$Mes = $_POST["Mes"] ?? '';
$ComprometidoMAOB = $_POST["ComprometidoMAOB"] ?? '';
$DisponibleMAOB = $_POST["DisponibleMAOB"] ?? '';
$ComprometidoEMCO = $_POST["ComprometidoEMCO"] ?? '';
$DisponibleEMCO = $_POST["DisponibleEMCO"] ?? '';
$ComprometidoEMEV = $_POST["ComprometidoEMEV"] ?? '';
$DisponibleEMEV = $_POST["DisponibleEMEV"] ?? '';
$TPCSEPE = $_POST["TPCSEPE"] ?? '';
$TPDSEPE = $_POST["TPDSEPE"] ?? '';
$ComprometidoPRES = $_POST["ComprometidoPRES"] ?? '';
$DisponiblePRES = $_POST["DisponiblePRES"] ?? '';
$ComprometidoMAOP = $_POST["ComprometidoMAOP"] ?? '';
$DisponibleMAOP = $_POST["DisponibleMAOP"] ?? '';
$TPCMASU = $_POST["TPCMASU"] ?? '';
$TPDMASU = $_POST["TPDMASU"] ?? '';
$ComprometidoPREM = $_POST["ComprometidoPREM"] ?? '';
$DisponiblePREM = $_POST["DisponiblePREM"] ?? '';
$ComprometidoMACO = $_POST["ComprometidoMACO"] ?? '';
$DisponibleMACO = $_POST["DisponibleMACO"] ?? '';
$ComprometidoIMDE = $_POST["ComprometidoIMDE"] ?? '';
$DisponibleIMDE = $_POST["DisponibleIMDE"] ?? '';
$ComprometidoSEFI = $_POST["ComprometidoSEFI"] ?? '';
$DisponibleSEFI = $_POST["DisponibleSEFI"] ?? '';
$ComprometidoSERBA = $_POST["ComprometidoSERBA"] ?? '';
$DisponibleSERBA = $_POST["DisponibleSERBA"] ?? '';
$ComprometidoTRAN = $_POST["ComprometidoTRAN"] ?? '';
$DisponibleTRAN = $_POST["DisponibleTRAN"] ?? '';
$ComprometidoGARE = $_POST["ComprometidoGARE"] ?? '';
$DisponibleGARE = $_POST["DisponibleGARE"] ?? '';
$TPCSEGE = $_POST["TPCSEGE"] ?? '';
$TPDSEGE = $_POST["TPDSEGE"] ?? '';
$ComprometidoVentas = $_POST["ComprometidoVentas"] ?? '';
$ObservacionesVentas = $_POST["ObservacionesVentas"] ?? '';
$CostoVLF = $_POST["CostoVLF"] ?? '';
$CostoFLF = $_POST["CostoFLF"] ?? '';
$CostoVMG = $_POST["CostoVMG"] ?? '';
$CostoFMG = $_POST["CostoFMG"] ?? '';
$CostoVLFRI = $_POST["CostoVLFRI"] ?? '';
$CostoFLFRI = $_POST["CostoFLFRI"] ?? '';

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

            $query = "UPDATE con_deptocontabilidad SET
                        Mes = ?,
                        
                        ComprometidoMAOB = ?, DisponibleMAOB = ?,
                        ComprometidoEMCO = ?, DisponibleEMCO = ?,
                        ComprometidoEMEV = ?, DisponibleEMEV = ?,
                        TPCSEPE = ?, TPDSEPE = ?,
                        
                        ComprometidoPRES = ?, DisponiblePRES = ?,
                        ComprometidoMAOP = ?, DisponibleMAOP = ?,
                        TPCMASU = ?, TPDMASU = ?,
                        
                        ComprometidoPREM = ?, DisponiblePREM = ?,
                        ComprometidoMACO = ?, DisponibleMACO = ?,
                        ComprometidoIMDE = ?, DisponibleIMDE = ?,
                        ComprometidoSEFI = ?, DisponibleSEFI = ?,
                        ComprometidoSERBA = ?, DisponibleSERBA = ?,
                        ComprometidoTRAN = ?, DisponibleTRAN = ?,
                        ComprometidoGARE = ?, DisponibleGARE = ?,
                        TPCSEGE = ?, TPDSEGE = ?,
                        
                        ComprometidoVentas = ?, ObservacionesVentas = ?,
                        CostoVLF = ?, CostoFLF = ?,
                        CostoVMG = ?, CostoFMG = ?,
                        CostoVLFRI = ?, CostoFLFRI = ?
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
    $query = "UPDATE con_deptocontabilidad SET
                Mes = ?,
                
                ComprometidoMAOB = ?, DisponibleMAOB = ?,
                ComprometidoEMCO = ?, DisponibleEMCO = ?,
                ComprometidoEMEV = ?, DisponibleEMEV = ?,
                TPCSEPE = ?, TPDSEPE = ?,
                
                ComprometidoPRES = ?, DisponiblePRES = ?,
                ComprometidoMAOP = ?, DisponibleMAOP = ?,
                TPCMASU = ?, TPDMASU = ?,
                
                ComprometidoPREM = ?, DisponiblePREM = ?,
                ComprometidoMACO = ?, DisponibleMACO = ?,
                ComprometidoIMDE = ?, DisponibleIMDE = ?,
                ComprometidoSEFI = ?, DisponibleSEFI = ?,
                ComprometidoSERBA = ?, DisponibleSERBA = ?,
                ComprometidoTRAN = ?, DisponibleTRAN = ?,
                ComprometidoGARE = ?, DisponibleGARE = ?,
                TPCSEGE = ?, TPDSEGE = ?,
                
                ComprometidoVentas = ?, ObservacionesVentas = ?,
                CostoVLF = ?, CostoFLF = ?,
                CostoVMG = ?, CostoFMG = ?,
                CostoVLFRI = ?, CostoFLFRI = ?
            WHERE id = ?";
}
if($firma_realizada) {
    $query = "UPDATE con_deptocontabilidad SET
                Mes = ?,
                
                ComprometidoMAOB = ?, DisponibleMAOB = ?,
                ComprometidoEMCO = ?, DisponibleEMCO = ?,
                ComprometidoEMEV = ?, DisponibleEMEV = ?,
                TPCSEPE = ?, TPDSEPE = ?,
                
                ComprometidoPRES = ?, DisponiblePRES = ?,
                ComprometidoMAOP = ?, DisponibleMAOP = ?,
                TPCMASU = ?, TPDMASU = ?,
                
                ComprometidoPREM = ?, DisponiblePREM = ?,
                ComprometidoMACO = ?, DisponibleMACO = ?,
                ComprometidoIMDE = ?, DisponibleIMDE = ?,
                ComprometidoSEFI = ?, DisponibleSEFI = ?,
                ComprometidoSERBA = ?, DisponibleSERBA = ?,
                ComprometidoTRAN = ?, DisponibleTRAN = ?,
                ComprometidoGARE = ?, DisponibleGARE = ?,
                TPCSEGE = ?, TPDSEGE = ?,
                
                ComprometidoVentas = ?, ObservacionesVentas = ?,
                CostoVLF = ?, CostoFLF = ?,
                CostoVMG = ?, CostoFMG = ?,
                CostoVLFRI = ?, CostoFLFRI = ?,
                
                firma_usuario = ?, fecha_firma = ?
            WHERE id = ?";
} else {
    $query = "UPDATE con_deptocontabilidad SET
                Mes = ?,
                
                ComprometidoMAOB = ?, DisponibleMAOB = ?,
                ComprometidoEMCO = ?, DisponibleEMCO = ?,
                ComprometidoEMEV = ?, DisponibleEMEV = ?,
                TPCSEPE = ?, TPDSEPE = ?,
                
                ComprometidoPRES = ?, DisponiblePRES = ?,
                ComprometidoMAOP = ?, DisponibleMAOP = ?,
                TPCMASU = ?, TPDMASU = ?,
                
                ComprometidoPREM = ?, DisponiblePREM = ?,
                ComprometidoMACO = ?, DisponibleMACO = ?,
                ComprometidoIMDE = ?, DisponibleIMDE = ?,
                ComprometidoSEFI = ?, DisponibleSEFI = ?,
                ComprometidoSERBA = ?, DisponibleSERBA = ?,
                ComprometidoTRAN = ?, DisponibleTRAN = ?,
                ComprometidoGARE = ?, DisponibleGARE = ?,
                TPCSEGE = ?, TPDSEGE = ?,
                
                ComprometidoVentas = ?, ObservacionesVentas = ?,
                CostoVLF = ?, CostoFLF = ?,
                CostoVMG = ?, CostoFMG = ?,
                CostoVLFRI = ?, CostoFLFRI = ?
            WHERE id = ?";  
}
$stmt = mysqli_prepare($link, $query);
if($firma_realizada){
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssssss", 
        $Mes,
        
        $ComprometidoMAOB, $DisponibleMAOB,
        $ComprometidoEMCO, $DisponibleEMCO,
        $ComprometidoEMEV, $DisponibleEMEV,
        $TPCSEPE, $TPDSEPE,
        
        $ComprometidoPRES, $DisponiblePRES,
        $ComprometidoMAOP, $DisponibleMAOP,
        $TPCMASU, $TPDMASU,
        
        $ComprometidoPREM, $DisponiblePREM,
        $ComprometidoMACO, $DisponibleMACO,
        $ComprometidoIMDE, $DisponibleIMDE,
        $ComprometidoSEFI, $DisponibleSEFI,
        $ComprometidoSERBA, $DisponibleSERBA,
        $ComprometidoTRAN, $DisponibleTRAN,
        $ComprometidoGARE, $DisponibleGARE,
        $TPCSEGE, $TPDSEGE,
        
        $ComprometidoVentas, $ObservacionesVentas,
        $CostoVLF, $CostoFLF,
        $CostoVMG, $CostoFMG,
        $CostoVLFRI, $CostoFLFRI,
        
        $firma_usuario, $fecha_firma,
        $ID
    );
}else {
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssss", 
        $Mes,
        
        $ComprometidoMAOB, $DisponibleMAOB,
        $ComprometidoEMCO, $DisponibleEMCO,
        $ComprometidoEMEV, $DisponibleEMEV,
        $TPCSEPE, $TPDSEPE,
        
        $ComprometidoPRES, $DisponiblePRES,
        $ComprometidoMAOP, $DisponibleMAOP,
        $TPCMASU, $TPDMASU,
        
        $ComprometidoPREM, $DisponiblePREM,
        $ComprometidoMACO, $DisponibleMACO,
        $ComprometidoIMDE, $DisponibleIMDE,
        $ComprometidoSEFI, $DisponibleSEFI,
        $ComprometidoSERBA, $DisponibleSERBA,
        $ComprometidoTRAN, $DisponibleTRAN,
        $ComprometidoGARE, $DisponibleGARE,
        $TPCSEGE, $TPDSEGE,
        
        $ComprometidoVentas, $ObservacionesVentas,
        $CostoVLF, $CostoFLF,
        $CostoVMG, $CostoFMG,
        $CostoVLFRI, $CostoFLFRI,
        
        $ID
    );
}

// 5. Ejecutar la declaración y manejar el resultado
$ejecucion_exitosa = mysqli_stmt_execute($stmt);
$filas_afectadas = mysqli_stmt_affected_rows($stmt);
$error_sql = mysqli_stmt_error($stmt);

// Cerrar la declaración
mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Modificación de Indicadores de Contabilidad</title> 
    <!-- Enlaces y estilos de la página de resultados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Se mantiene el estilo original para la página de resultado -->
    <link rel="stylesheet" href="../css/hacer.css"> 
</head>
<body>
    <div class="contenedor">
        <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
        <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
        
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
        <!-- El formulario de origen es ModContabilidad.php, por lo que el regreso es a ese archivo -->
        <a href="ModContabilidad.php" class="btn">Regresar a la Modificación</a>
        <br><a href='MenuModifi.php' class="home-link"><img src='../imagenes/home.png' height='100' width='90' alt="Ir al Menú Principal"></a>
    </div>
</body>
</html>
