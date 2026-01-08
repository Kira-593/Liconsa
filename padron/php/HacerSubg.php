<?php
date_default_timezone_set('America/Mexico_City');
session_start();
// Incluye la conexión a la base de datos de formularios
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
    $update_query = "UPDATE p_subgerenciaabasto SET firma_usuario = '', fecha_firma = NULL = '' WHERE id = $ID";
    
    if (mysqli_query($link, $update_query)) {
        echo "<script>alert('Firma deshacha correctamente. El formulario está listo para editar.'); window.location.href = 'actualizarSubg.php?id=$ID';</script>";
    } else {
        echo "<script>alert('Error al deshacer firma: " . addslashes(mysqli_error($link)) . "'); window.history.back();</script>";
    }
    exit();
}


// 1. Obtener los datos del formulario
$id = $_POST["id"];
$Mes = $_POST["Mes"];
$MetaETM = $_POST["MetaETM"];
$CantidadDTC = $_POST["CantidadDTC"];
$CantidadFTC = $_POST["CantidadFTC"];
$TBuno = $_POST["TBuno"];
$Porcentajebuno = $_POST["Porcentajebuno"];
$TBdos = $_POST["TBdos"];
$Porcentajetbdos = $_POST["Porcentajetbdos"];
$TBtres = $_POST["TBtres"];
$Porcentajetbtres = $_POST["Porcentajetbtres"];
$TBCuatro = $_POST["TBCuatro"];
$Porcentajetbcuatro = $_POST["Porcentajetbcuatro"];
$TBCinco = $_POST["TBCinco"];
$Porcentajetbcinco = $_POST["Porcentajetbcinco"];
$TBseis = $_POST["TBseis"];
$Porcentajetbseis = $_POST["Porcentajetbseis"];
$TBsiete = $_POST["TBsiete"];
$Porcentajetbsiete = $_POST["Porcentajetbsiete"];
$BajasTB = $_POST["BajasTB"];
$AltasTA = $_POST["AltasTA"];
$VariacionTV = $_POST["VariacionTV"];

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
            
            // Consulta CON firma
            $query = "UPDATE p_subgerenciaabasto SET
                     Mes = ?,
                     MetaETM = ?, 
                     CantidadDTC = ?, 
                     CantidadFTC = ?, 
                     TBuno = ?, 
                     Porcentajebuno = ?, 
                     TBdos = ?, 
                     Porcentajetbdos = ?, 
                     TBtres = ?, 
                     Porcentajetbtres = ?, 
                     TBCuatro = ?, 
                     Porcentajetbcuatro = ?, 
                     TBCinco = ?, 
                     Porcentajetbcinco = ?, 
                     TBseis = ?, 
                     Porcentajetbseis = ?, 
                     TBsiete = ?, 
                     Porcentajetbsiete = ?, 
                     BajasTB = ?, 
                     AltasTA = ?, 
                     VariacionTV = ?,
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
    // Consulta SIN firma
    $query = "UPDATE p_subgerenciaabasto SET
             Mes = ?,
             MetaETM = ?, 
             CantidadDTC = ?, 
             CantidadFTC = ?, 
             TBuno = ?, 
             Porcentajebuno = ?, 
             TBdos = ?, 
             Porcentajetbdos = ?, 
             TBtres = ?, 
             Porcentajetbtres = ?, 
             TBCuatro = ?, 
             Porcentajetbcuatro = ?, 
             TBCinco = ?, 
             Porcentajetbcinco = ?, 
             TBseis = ?, 
             Porcentajetbseis = ?, 
             TBsiete = ?, 
             Porcentajetbsiete = ?, 
             BajasTB = ?, 
             AltasTA = ?, 
             VariacionTV = ?
             WHERE id = ?";
}

// Preparar la consulta para actualizar el formulario
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
    // Vincular parámetros CON firma (24 parámetros: 21 campos + 2 firma + 1 ID)
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssss", 
        $Mes, $MetaETM, $CantidadDTC, $CantidadFTC, 
        $TBuno, $Porcentajebuno, $TBdos, $Porcentajetbdos, 
        $TBtres, $Porcentajetbtres, $TBCuatro, $Porcentajetbcuatro, 
        $TBCinco, $Porcentajetbcinco, $TBseis, $Porcentajetbseis, 
        $TBsiete, $Porcentajetbsiete, $BajasTB, $AltasTA, 
        $VariacionTV, $firma_usuario, $fecha_firma, $id);
} else {
    // Vincular parámetros SIN firma (22 parámetros: 21 campos + 1 ID)
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", 
        $Mes, $MetaETM, $CantidadDTC, $CantidadFTC, 
        $TBuno, $Porcentajebuno, $TBdos, $Porcentajetbdos, 
        $TBtres, $Porcentajetbtres, $TBCuatro, $Porcentajetbcuatro, 
        $TBCinco, $Porcentajetbcinco, $TBseis, $Porcentajetbseis, 
        $TBsiete, $Porcentajetbsiete, $BajasTB, $AltasTA, 
        $VariacionTV, $id);
}

// Ejecutar la consulta preparada
$ejecucion_exitosa = mysqli_stmt_execute($stmt);
$filas_afectadas = mysqli_stmt_affected_rows($stmt);
$error_sql = mysqli_stmt_error($stmt);

// Cerrar el statement
mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Indicador Modificado</title>
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
        <!-- Enlaces de regreso -->
        <a href="./ModSubg.php" class="btn">Regresar a Actualizar Otro Formulario</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>