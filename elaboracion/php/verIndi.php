<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["sc"] ?? '';

$query = "SELECT * FROM e_indicador WHERE id = '$id'";
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

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Información de Indicadores de Elaboración</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/verIndi.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
    
</head>
<body>

    <main class='contenedor'>
        <h1>Información de Indicadores de Elaboración</h1>
        <h4>Elaboración</h4>
        
        <section class='registro'>
            <h2>Información Encontrada</h2>
            <hr>
            
            <table class='info-tabla'>
                <tr><td>Clave de Registro:</td><td>{$row['Claveregis']}</td></tr>
                <tr><td>Fecha de Actualización:</td><td>" . date('d/m/Y', strtotime($row['FechaAct'])) . "</td></tr>
                <tr><td>Fecha de Elaboración:</td><td>{$mes_formateado}</td></tr>
                <tr><td>Periodo:</td><td>{$periodo_formateado}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📊 Cumplimiento al Programa de Distribución Mensual de Leche del Programa de Abasto Social</div>
            <table class='info-tabla'>
                <tr><td>Despacho Brutos del Programa de Abasto Social:</td><td>{$row['DBPAS']} Litros</td></tr>
                <tr><td>Programa de Despacho Original Autorizado:</td><td>{$row['PDOACP']} Litros</td></tr>
                <tr><td>Litros Resultantes del Ajuste al Programa:</td><td>{$row['LRAPMDOL']} (±) Litros</td></tr>
                <tr><td>Porcentaje de Cumplimiento:</td><td>{$row['PC']}%</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaDMLPS']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptDMLPS']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaDMLPS']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🚛 Entrega de Producto no Cubiertas por Factores Imputables a la Operación de Plantas</div>
            <table class='info-tabla'>
                <tr><td>Leche no Entregada por Factores Imputables a Planta:</td><td>{$row['CDLPAS']} Litros</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaEPNC']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptEPNC']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaEPNC']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🏭 Cumplimiento Con la Producción Solicitada en el Programa de Distribución</div>
            <table class='info-tabla'>
                <tr><td>Despacho Real:</td><td>{$row['DespaReal']} Litros</td></tr>
                <tr><td>Despacho Programado:</td><td>{$row['DespaProg']} Litros</td></tr>
                <tr><td>Litros de Leche del Programa de Producción:</td><td>{$row['LechePrograma']} Litros</td></tr>
                <tr><td>Porcentaje de Producción de leche:</td><td>{$row['PorcentajeProduccion']}%</td></tr>
                <tr><td>Porcentaje de Cumplimiento de la Producción Solicitada:</td><td>{$row['PPL']}%</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaCPSP']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCPSP']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCPSP']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🧪 Calidad de la leche de Abasto</div>
            <div class='subseccion-titulo'>Grasa</div>
            <table class='info-tabla'>
                <tr><td>LCMGV (Grasa):</td><td>{$row['GLCMGV']} g/l</td></tr>
                <tr><td>LPD (Grasa):</td><td>{$row['GLPD']} g/l</td></tr>
            </table>
            
            <div class='subseccion-titulo'>Proteína</div>
            <table class='info-tabla'>
                <tr><td>LCMGV (Proteína):</td><td>{$row['PLCMGV']} g/l</td></tr>
                <tr><td>LPD (Proteína):</td><td>{$row['PLPD']} g/l</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaCLA']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCLA']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCLA']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🧼 Cumplimiento de las Buenas Prácticas de Higiene y Manufactura</div>
            <table class='info-tabla'>
                <tr><td>Porcentaje de Cumplimiento del PCC:</td><td>{$row['PCBH']}%</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaCBC']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCBC']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCBC']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📋 Cumplimiento a los Lineamientos Internos y Criterios de la NOM 251-SSA1-2009</div>
            <table class='info-tabla'>
                <tr><td>Porcentaje de Cumplimiento de los 129 Puntos:</td><td>{$row['PCCL']}%</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaCLI']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCLI']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCLI']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Información Adicional</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td class='texto-largo'>{$row['Responsable']}</td></tr>
                <tr><td>Fuente:</td><td class='texto-largo'>{$row['Fuente']}</td></tr>
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
                    <input type='hidden' name='tabla' value='e_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='e_indicador'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConElaboracion.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                <a href='MenuIndi.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
            </div>
        </section>
        
    </main>
</body>
</html>
";

include "Cerrar.php";
?>