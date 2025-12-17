<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["sc"] ?? '';

$query = "SELECT * FROM g_indicador_ma WHERE id = '$id'";
$res = mysqli_query($link, $query);
$row = mysqli_fetch_array($res);

// Verificar si se encontró el registro
if (!$row) {
    die("<div class='alert alert-danger'>No se encontró el registro solicitado.</div>");
}

// Determinar textos y clases para los botones de permisos
$texto_modificar = $row['permitir_modificar'] ? 'Bloquear Modificación' : 'Permitir Modificar';
$texto_firmar = $row['permitir_firmar'] ? 'Bloquear Firma' : 'Permitir Firmar';

// Determinar las clases CSS para los botones
$clase_modificar = $row['permitir_modificar'] ? 'btn btn-warning' : 'btn btn-success';
$clase_firmar = $row['permitir_firmar'] ? 'btn btn-warning' : 'btn btn-success';

// Formatear fechas para mejor visualización
$mes_formateado = date('d/m/Y', strtotime($row['Mes']));
$periodo_formateado = date('d/m/Y', strtotime($row['Periodo']));
$fecha_firma_formateada = $row['fecha_firma'] ? date('d/m/Y H:i:s', strtotime($row['fecha_firma'])) : 'No firmado';

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Información de Indicadores de Gestión del Ambiente de trabajo</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../css/verIndiMa.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Indicadores de Gestión del Ambiente de trabajo</h1>
        <h1>y Competencias de Personal</h1>
        <hr>
        
        <section class='registro'>
            <h2>Información Encontrada</h2>
            <hr>
            
            <div class='seccion-titulo'>📋 Datos Generales</div>
            <table class='info-tabla'>
                <tr><td>Clave de Registro:</td><td>{$row['Claveregis']}</td></tr>
                <tr><td>Fecha de Elaboración:</td><td>{$mes_formateado}</td></tr>
                <tr><td>Periodo:</td><td>{$periodo_formateado}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🎓 Cumplimientos de la Capacitación</div>
            <table class='info-tabla'>
                <tr><td>Capacitaciones Impartidas:</td><td>{$row['CapaImpar']}</td></tr>
                <tr><td>Capacitaciones Programadas:</td><td>{$row['CapaProg']}</td></tr>
                <tr><td>Porcentaje de Cumplimiento:</td><td>{$row['PorCumplimientoCAP']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCC']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCC']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCC']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📊 Evaluación Técnica</div>
            <table class='info-tabla'>
                <tr><td>Nuevos Ingresos al Puesto:</td><td>{$row['NuevosIP']}</td></tr>
                <tr><td>Número de Evaluaciones:</td><td>{$row['NumEvaluaciones']}</td></tr>
                <tr><td>Porcentaje de Cumplimiento:</td><td>{$row['PorCumplimientoET']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaET']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptET']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaET']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📋 Fuente de Información</div>
            <table class='info-tabla'>
                <tr><td>Fuente:</td><td>{$row['Fuente']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Responsabilidad</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>✍️ Información de Firma</div>
            <table class='info-tabla'>
                <tr><td>Firma del Usuario:</td><td>" . ($row['firma_usuario'] ? $row['firma_usuario'] : 'No firmado') . "</td></tr>
                <tr><td>Fecha de Firma:</td><td>{$fecha_firma_formateada}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🔐 Estado de Permisos</div>
            <table class='info-tabla'>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            </table>
            
            <hr>
            
            <div class='permisos-botones'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='g_indicador_ma'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='g_indicador_ma'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConIndicadoresMa.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                
                <a href='MenuIndiMa.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='80' width='80'></a>
            </div>
        </section>
    </div>
</body>
</html>
";

include "Cerrar.php";
?>