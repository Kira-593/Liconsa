<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["id"] ?? $_GET["sc"] ?? '';

$query = "SELECT * FROM m_indicador WHERE id = '$id'";
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
    <title>Información de Indicadores de Mantenimiento</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../css/verIndi.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Información de Indicadores de Mantenimiento</h1>
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
            
            <div class='seccion-titulo'>💰 Gastos de Operación</div>
            <table class='info-tabla'>
                <tr><td>Presupuesto Ejercido:</td><td>{$row['PresEje']}</td></tr>
                <tr><td>Gasto Autorizado:</td><td>{$row['GastoAutorizado']}</td></tr>
                <tr><td>Diferencia:</td><td>{$row['Diferiencia']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaGO']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptGO']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaGO']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>⚙️ Disponibilidad de Equipo Para la Producción, Envasado y ReHidratado</div>
            <table class='info-tabla'>
                <tr><td>Total de Horas Hombre Disponible:</td><td>{$row['HorasHombre']} horas</td></tr>
                <tr><td>Horas de paro:</td><td>{$row['HorasParo']} horas</td></tr>
                <tr><td>Total de Horas Disponibles:</td><td>{$row['HorasDisponibles']} horas</td></tr>
                <tr><td>Porcentaje de Disponibilidad del Equipo:</td><td>{$row['prc']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaDEP']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptDEP']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaDEP']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🔧 Trabajos Preventivos</div>
            <table class='info-tabla'>
                <tr><td>Trabajos Programados Ejecutados:</td><td>{$row['TPE']}</td></tr>
                <tr><td>Trabajos Programados:</td><td>{$row['TP']}</td></tr>
                <tr><td>Porcentaje de Trabajos Preventivos:</td><td>{$row['PorcentTP']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaTP']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptTP']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaTP']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🛠️ Trabajos Correctivos</div>
            <table class='info-tabla'>
                <tr><td>Trabajos correctivos realizados:</td><td>{$row['TC']}</td></tr>
                <tr><td>Porcentaje de Trabajos Correctivos:</td><td>{$row['PorcentTC']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaTC']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptTC']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaTC']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🔥 Consumo Térmico</div>
            <table class='info-tabla'>
                <tr><td>Consumo Térmico:</td><td>{$row['ConsumoTermico']} litros</td></tr>
                <tr><td>Litros de Leche Producida:</td><td>{$row['LitrosLecheProducidatermica']} litros</td></tr>
                <tr><td>Consumo Total Térmico:</td><td>{$row['ConsTT']} litros/litro</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCT']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCT']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCT']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>💧 Consumo de Agua</div>
            <table class='info-tabla'>
                <tr><td>Consumo de Agua:</td><td>{$row['ConsumoAgua']} litros</td></tr>
                <tr><td>Litros de Leche Producida:</td><td>{$row['LitrosLecheProducida']} litros</td></tr>
                <tr><td>Consumo Total de Agua:</td><td>{$row['ConsTA']} litros/litro</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCA']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCA']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCA']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>⚡ Consumo Eléctrico</div>
            <table class='info-tabla'>
                <tr><td>Consumo Eléctrico:</td><td>{$row['ConsumoElectrico']} kWh</td></tr>
                <tr><td>Litros de Leche Producida:</td><td>{$row['LitrosLecheProducidaElectrico']} litros</td></tr>
                <tr><td>Consumo Total Eléctrico:</td><td>{$row['ConsTE']} kWh/litro</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaCE']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptCE']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaCE']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Responsabilidad</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
                <tr><td>Fuente:</td><td>{$row['Fuente']}</td></tr>
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
                    <input type='hidden' name='tabla' value='m_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='m_indicador'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConIndicador.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                
                <a href='MenuIndi.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='80' width='80'></a>
            </div>
        </section>
    </div>
</body>
</html>
";

include "Cerrar.php";
?>