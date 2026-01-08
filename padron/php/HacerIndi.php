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
    $update_query = "UPDATE p_indicador SET firma_usuario = '', fecha_firma = NULL = '' WHERE id = $ID";
    
    if (mysqli_query($link, $update_query)) {
        echo "<script>alert('Firma deshacha correctamente. El formulario está listo para editar.'); window.location.href = 'actualizarIndi.php?id=$ID';</script>";
    } else {
        echo "<script>alert('Error al deshacer firma: " . addslashes(mysqli_error($link)) . "'); window.history.back();</script>";
    }
    exit();
}

// 1. Obtener el ID
$ID = $_POST["id"] ?? '';

// 2. Obtener los 44 campos de datos del formulario
$Claveregis = $_POST["Claveregis"] ?? '';
$FechaAct = $_POST["FechaAct"] ?? '';
$Mes = $_POST["Mes"] ?? '';
$Periodo = $_POST["Periodo"] ?? '';
$NumBenefi = $_POST["NumBenefi"] ?? '';
$MetaBeneficiarios = $_POST["MetaBeneficiarios"] ?? '';
$MetaReal = $_POST["MetaReal"] ?? '';
$MetaEsperadaMB = $_POST["MetaEsperadaMB"] ?? '';
$RangoAceptMB = $_POST["RangoAceptMB"] ?? '';
$TendenciaDeseadaMB = $_POST["TendenciaDeseadaMB"] ?? '';
$LitrosVendidos = $_POST["LitrosVendidos"] ?? '';
$NumBenefiActivos = $_POST["NumBenefiActivos"] ?? '';
$DiasVenta = $_POST["DiasVenta"] ?? '';
$FacRetLi = $_POST["FacRetLi"] ?? '';
$MetaEsperadaFRL = $_POST["MetaEsperadaFRL"] ?? '';
$RangoAceptFRL = $_POST["RangoAceptFRL"] ?? '';
$TendenciaDeseadaFRL = $_POST["TendenciaDeseadaFRL"] ?? '';
$LitrosVendidosPol = $_POST["LitrosVendidosPol"] ?? '';
$NumBenefiActivosPol = $_POST["NumBenefiActivosPol"] ?? '';
$DiasVentaPol = $_POST["DiasVentaPol"] ?? '';
$FacRetPol = $_POST["FacRetPol"] ?? '';
$MetaEsperadaFRP = $_POST["MetaEsperadaFRP"] ?? '';
$RangoAceptFRP = $_POST["RangoAceptFRP"] ?? '';
$TendenciaDeseadaFRP = $_POST["TendenciaDeseadaFRP"] ?? '';
$TNE = $_POST["TNE"] ?? '';
$FamiliasInscritas = $_POST["FamiliasInscritas"] ?? '';
$PorcentajeTNE = $_POST["PorcentajeTNE"] ?? '';
$MetaEsperadaTNE = $_POST["MetaEsperadaTNE"] ?? '';
$RangoAceptTNE = $_POST["RangoAceptTNE"] ?? '';
$TendenciaDeseadaTNE = $_POST["TendenciaDeseadaTNE"] ?? '';
$QuejasRecibidas = $_POST["QuejasRecibidas"] ?? '';
$QuejasAtendidas = $_POST["QuejasAtendidas"] ?? '';
$PQNA = $_POST["PQNA"] ?? '';
$MetaEsperadaAQ = $_POST["MetaEsperadaAQ"] ?? '';
$RangoAceptAQ = $_POST["RangoAceptAQ"] ?? '';
$TendenciaDeseadaAQ = $_POST["TendenciaDeseadaAQ"] ?? '';
$TotalEncues = $_POST["TotalEncues"] ?? '';
$MaxPuntos = $_POST["MaxPuntos"] ?? '';
$TPTE = $_POST["TPTE"] ?? '';
$PorcentajeEncuestas = $_POST["PorcentajeEncuestas"] ?? '';
$MetaEsperadaES = $_POST["MetaEsperadaES"] ?? '';
$RangoAceptES = $_POST["RangoAceptES"] ?? '';
$TendenciaDeseadaES = $_POST["TendenciaDeseadaES"] ?? '';
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

// --- Construcción de la Consulta ---

// Base de la consulta con los 44 campos de datos
$sql_base = "UPDATE p_indicador SET 
    Claveregis=?, FechaAct=?, Mes=?, Periodo=?, 
    NumBenefi=?, MetaBeneficiarios=?, MetaReal=?, MetaEsperadaMB=?, RangoAceptMB=?, TendenciaDeseadaMB=?,
    LitrosVendidos=?, NumBenefiActivos=?, DiasVenta=?, FacRetLi=?, MetaEsperadaFRL=?, RangoAceptFRL=?, TendenciaDeseadaFRL=?,
    LitrosVendidosPol=?, NumBenefiActivosPol=?, DiasVentaPol=?, FacRetPol=?, MetaEsperadaFRP=?, RangoAceptFRP=?, TendenciaDeseadaFRP=?,
    TNE=?, FamiliasInscritas=?, PorcentajeTNE=?, MetaEsperadaTNE=?, RangoAceptTNE=?, TendenciaDeseadaTNE=?,
    QuejasRecibidas=?, QuejasAtendidas=?, PQNA=?, MetaEsperadaAQ=?, RangoAceptAQ=?, TendenciaDeseadaAQ=?,
    TotalEncues=?, MaxPuntos=?, TPTE=?, PorcentajeEncuestas=?, MetaEsperadaES=?, RangoAceptES=?, TendenciaDeseadaES=?,
    Responsable=?, Fuente=?";

if ($firma_realizada) {
    // Si hay firma, agregamos los campos de firma y el WHERE
    $query = $sql_base . ", firma_usuario=?, fecha_firma=? WHERE id=?";
    // 44 datos + 2 firma + 1 ID = 47 variables.
    // Usamos str_repeat para generar 'ssss...' de forma segura.
    // 46 strings + 1 int (id)
    $tipos = str_repeat("s", 47) . "i"; 
} else {
    // Si no hay firma, solo agregamos el WHERE
    $query = $sql_base . " WHERE id=?";
    // 44 datos + 1 ID = 45 variables.
    $tipos = str_repeat("s", 45) . "i";
}

$stmt = mysqli_prepare($link, $query);

if (!$stmt) {
    die("Error prepare: " . mysqli_error($link));
}

// --- Vinculación de Parámetros ---

// Array base con los 44 datos
$params = [
    $Claveregis, $FechaAct, $Mes, $Periodo,
    $NumBenefi, $MetaBeneficiarios, $MetaReal, $MetaEsperadaMB, $RangoAceptMB, $TendenciaDeseadaMB,
    $LitrosVendidos, $NumBenefiActivos, $DiasVenta, $FacRetLi, $MetaEsperadaFRL, $RangoAceptFRL, $TendenciaDeseadaFRL,
    $LitrosVendidosPol, $NumBenefiActivosPol, $DiasVentaPol, $FacRetPol, $MetaEsperadaFRP, $RangoAceptFRP, $TendenciaDeseadaFRP,
    $TNE, $FamiliasInscritas, $PorcentajeTNE, $MetaEsperadaTNE, $RangoAceptTNE, $TendenciaDeseadaTNE,
    $QuejasRecibidas, $QuejasAtendidas, $PQNA, $MetaEsperadaAQ, $RangoAceptAQ, $TendenciaDeseadaAQ,
    $TotalEncues, $MaxPuntos, $TPTE, $PorcentajeEncuestas, $MetaEsperadaES, $RangoAceptES, $TendenciaDeseadaES,
    $Responsable, $Fuente
];

// Agregar campos extra según el caso
if ($firma_realizada) {
    $params[] = $firma_usuario;
    $params[] = $fecha_firma;
}

// El ID siempre va al final
$params[] = $ID;

// Usamos call_user_func_array para vincular dinámicamente
// Argumento 1: el statement
// Argumento 2: la cadena de tipos
// Argumentos 3...: las variables (pasadas por referencia para bind_param)

$bind_params = array();
$bind_params[] = $stmt;
$bind_params[] = $tipos;

// bind_param requiere referencias
foreach ($params as $key => $value) {
    $bind_params[] = &$params[$key];
}

call_user_func_array('mysqli_stmt_bind_param', $bind_params);

// Ejecutar
$ejecucion_exitosa = mysqli_stmt_execute($stmt);
$filas_afectadas = mysqli_stmt_affected_rows($stmt);
$error_sql = mysqli_stmt_error($stmt);

mysqli_stmt_close($stmt);
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
            include "Cerrar.php"; 
        ?>
        <a href="ModIndi.php" class="btn">Regresar a Modificar Indicadores</a><br>
        <br><a href='MenuIndi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>