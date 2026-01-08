<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["sc"] ?? '';

$query = "SELECT * FROM g_indicador_da WHERE id = '$id'";
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
    <link rel='stylesheet' href='../css/verIndiDa.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Indicadores</h1>
        <h4>Gestión del Ambiente de trabajo</h4>
        <h4>y de las Competencias de Personal</h4>
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
            
            <div class='seccion-titulo'>🧹 Ambiente de trabajo - Reporte de inspección de Órden seguridad y Limpieza</div>
            <table class='info-tabla'>
                <tr><td>No. de Satisfacciones:</td><td>{$row['NoSatis']}</td></tr>
                <tr><td>No. de Puntos:</td><td>{$row['NoPuntos']}</td></tr>
                <tr><td>Donde la Satisfacción es Equivalente a:</td><td>{$row['DndSat']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaRIO']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptRIO']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaRIO']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👷 Ambiente de Trabajo - Uniformes y Equipo de Protección</div>
            <table class='info-tabla'>
                <tr><td>No. de Satisfacciones:</td><td>{$row['NoSatisUnif']}</td></tr>
                <tr><td>No. de Puntos:</td><td>{$row['NoPuntosUnif']}</td></tr>
                <tr><td>Donde la Satisfacción es Equivalente a:</td><td>{$row['DndSatUnif']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaUTE']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptUTE']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaUTE']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>⚠️ Accidentes e Incidentes por Riesgo de Trabajo</div>
            <table class='info-tabla'>
                <tr><td>Cantidad de Accidentes:</td><td>{$row['CantAcci']}</td></tr>
                <tr><td>Dias Laborados:</td><td>{$row['DiasLaborados']}</td></tr>
                <tr><td>Frecuencia:</td><td>{$row['Frecuencia']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaAIR']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptAIR']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaAIR']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🚫 Actos y Condiciones Inseguras</div>
            <table class='info-tabla'>
                <tr><td>Actos y/o Condiciones Inseguras Reportadas:</td><td>{$row['CantActCondInseg']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaACI']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptACI']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaACI']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Responsabilidad</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📋 Fuente de Información</div>
            <table class='info-tabla'>
                <tr><td>Fuente:</td><td>{$row['ObservacionesRes']}</td></tr>
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
            
             " . (!empty($row['firma_usuario']) ? "
            <div class='seccion-titulo'>📝 Estado de Firma</div>
            <table class='info-tabla'>
                <tr><td>Documento Firmado por:</td><td>{$row['firma_usuario']}</td></tr>
                <tr><td>Fecha de Firma:</td><td>" . date('d/m/Y H:i:s', strtotime($row['fecha_firma'])) . "</td></tr>
            </table>
            " : "") . "

            
            <hr>
            
            <div class='permisos-botones'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='g_indicador_da'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='g_indicador_da'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConIndicadorDa.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                
                <a href='MenuIndiDa.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='80' width='80'></a>
            </div>
        </section>
    </div>
</body>
</html>
";

include "Cerrar.php";
?>