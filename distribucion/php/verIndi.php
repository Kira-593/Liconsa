<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["id"] ?? $_GET["sc"] ?? '';

$query = "SELECT * FROM d_indicador WHERE id = '$id'";
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
    <title>Información de Indicadores de Distribución</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../css/verIndi.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Información de Indicadores de Distribución</h1>
        <hr>
        
        <section class='registro'>
            <h2>Información Encontrada</h2>
            <hr>
            
            <div class='seccion-titulo'>📋 Datos Generales</div>
            <table class='info-tabla'>
                <tr><td>Clave de Registro:</td><td>{$row['Claveregis']}</td></tr>
                <tr><td>Fecha de Actualización:</td><td>" . date('d/m/Y', strtotime($row['FechaAct'])) . "</td></tr>
                <tr><td>Fecha de Elaboración:</td><td>{$mes_formateado}</td></tr>
                <tr><td>Periodo:</td><td>{$periodo_formateado}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🚚 Cumplimiento con el Despacho Programado de Leche Liquida P.A.S Tlaxcala</div>
            <table class='info-tabla'>
                <tr><td>Cumplimiento Real al Programa Diaria de Despacho:</td><td>{$row['CumplRealProgDia']}</td></tr>
                <tr><td>Programa Diario de Despacho:</td><td>{$row['ProgDiarioDespacho']}</td></tr>
                <tr><td>Porcentaje del cumplimiento:</td><td>{$row['PCDP']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaMB']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptMB']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaMB']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>💰 Cumplimiento de Ventas Programadas</div>
            <table class='info-tabla'>
                <tr><td>Venta Total:</td><td>{$row['Ventatot']}</td></tr>
                <tr><td>Dotación Entregada:</td><td>{$row['DotEntre']}</td></tr>
                <tr><td>Cumplimiento de Ventas Programadas:</td><td>{$row['CumplimientoVentas']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCVP']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCVP']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCVP']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📦 Control de Envases Rotos</div>
            <table class='info-tabla'>
                <tr><td>Mermas:</td><td>{$row['MermasEnva']}</td></tr>
                <tr><td>Dotación:</td><td>{$row['DotEnva']}</td></tr>
                <tr><td>Cantidad de Envases Rotos:</td><td>{$row['CantidadEnvRotos']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCER']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCER']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCER']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>↩️ Devoluciones del P.A.S. Tlaxcala</div>
            <table class='info-tabla'>
                <tr><td>Devoluciones:</td><td>{$row['Devoluciones']}</td></tr>
                <tr><td>Dotación:</td><td>{$row['DotDev']}</td></tr>
                <tr><td>Devoluciones del P.A.S. Tlaxcala:</td><td>{$row['DevolucionesDPAS']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaDPAS']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptDPAS']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaDPAS']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>💸 Gastos de Distribución</div>
            <table class='info-tabla'>
                <tr><td>Gastos Totales de Distribución:</td><td>{$row['GastosTD']}</td></tr>
                <tr><td>Litros Distribución:</td><td>{$row['LitrosDistribucion']}</td></tr>
                <tr><td>Gastos de distribución:</td><td>{$row['GastosDistribucion']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaGD']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptGD']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaGD']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Responsabilidad</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
                <tr><td>Observaciones:</td><td>{$row['Observ']}</td></tr>
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
                    <input type='hidden' name='tabla' value='d_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='d_indicador'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConDistribucion.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                
                <a href='distribucionP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='80' width='80'></a>
            </div>
        </section>
    </div>
</body>
</html>
";

include "Cerrar.php";
?>