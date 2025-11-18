<?php
date_default_timezone_set('America/Mexico_City');

// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los 9 datos del formulario de Venta de Leche
$ID = $_POST["id"] ?? ''; // ID es la clave para el UPDATE
$Indicador = $_POST["Indicador"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$CodigoTC = $_POST["CodigoTC"] ?? '';
$DescripcionTD = $_POST["DescripcionTD"] ?? '';
$CantidadITC = $_POST["CantidadITC"] ?? '';
$CantidadETC = $_POST["CantidadETC"] ?? '';
$CantidadCTC = $_POST["CantidadCTC"] ?? '';
$CantidadFTC = $_POST["CantidadFTC"] ?? '';

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

            $query = "UPDATE a_ventaleche SET
                        Indicador='$Indicador', 
                        Mes='$Mes', 
                        CodigoTC='$CodigoTC', 
                        DescripcionTD='$DescripcionTD', 
                        CantidadITC='$CantidadITC', 
                        CantidadETC='$CantidadETC', 
                        CantidadCTC='$CantidadCTC', 
                        CantidadFTC='$CantidadFTC',
                        firma_usuario='$firma_usuario',
                        fecha_firma='$fecha_firma'
                    WHERE id='$ID'"; 

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
    // 2. Construir la consulta UPDATE SIN firma
    $query = "UPDATE a_ventaleche SET
                Indicador='$Indicador',
                Mes='$Mes',
                CodigoTC='$CodigoTC',
                DescripcionTD='$DescripcionTD',
                CantidadITC='$CantidadITC',
                CantidadETC='$CantidadETC',
                CantidadCTC='$CantidadCTC',
                CantidadFTC='$CantidadFTC'
            WHERE id='$ID'";

}


if ($firma_realizada) {
    // Consulta preparada CON firma
    $query = "UPDATE a_ventaleche SET 
                Indicador = ?, 
                Mes = ?, 
                CodigoTC = ?, 
                DescripcionTD = ?, 
                CantidadITC = ?, 
                CantidadETC = ?, 
                CantidadCTC = ?, 
                CantidadFTC = ?,
                firma_usuario = ?,
                fecha_firma = ?
            WHERE id = ?";
} else {
    // Consulta preparada SIN firma
    $query = "UPDATE a_ventaleche SET 
                Indicador = ?, 
                Mes = ?, 
                CodigoTC = ?, 
                DescripcionTD = ?, 
                CantidadITC = ?, 
                CantidadETC = ?, 
                CantidadCTC = ?, 
                CantidadFTC = ?
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
    mysqli_stmt_bind_param($stmt, "ssssssssssi", 
        $Indicador, 
        $Mes, 
        $CodigoTC, 
        $DescripcionTD, 
        $CantidadITC, 
        $CantidadETC, 
        $CantidadCTC, 
        $CantidadFTC,
        $firma_usuario,
        $fecha_firma,
        $ID
    );
} else {
    mysqli_stmt_bind_param($stmt, "sssssssssi",
        $Indicador, 
        $Mes, 
        $CodigoTC, 
        $DescripcionTD, 
        $CantidadITC, 
        $CantidadETC, 
        $CantidadCTC, 
        $CantidadFTC,
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se usa el CSS de hacer.css para el mensaje de resultado -->
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
        <!-- Enlaces de navegación actualizados para el contexto de Venta de Leche -->
        <a href="ModVenta.php" class="btn">Regresar a Actualizar Otro Formulario</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>