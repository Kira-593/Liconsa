<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["sc"] ?? '';

$query = "SELECT * FROM r_indicador WHERE id = '$id'";
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
    <title>Información de Indicadores de Recursos Financieros</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='../css/verIndi.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Indicadores</h1>
        <h4>Recursos Financieros</h4>
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
            
            <div class='seccion-titulo'>💰 Suficiencia Presupuestal</div>
            <table class='info-tabla'>
                <tr><td>Número de Expendientes de Suficiencia Presupuestal Autorizados:</td><td>{$row['ExpedinAut']}</td></tr>
                <tr><td>Número de Expendientes de Suficiencia Presupuestal Recibidos:</td><td>{$row['ExpendiReci']}</td></tr>
                <tr><td>Porcentaje de Expendientes Autorizados:</td><td>{$row['PorcentajeExpAut']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaMB']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptMB']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaMB']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Responsabilidad</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📋 Fuente de Información</div>
            <table class='info-tabla'>
                <tr><td>Fuente:</td><td>{$row['Fuente']}</td></tr>
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
                    <input type='hidden' name='tabla' value='r_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='r_indicador'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConRecursos.php' class='btn btn-primary'>Realizar Otra Consulta</a>
                
                <a href='MenuIndi.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='80' width='80'></a>
            </div>
        </section>
    </div>
</body>
</html>
";

include "Cerrar.php";
?>