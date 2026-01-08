<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["sc"] ?? '';

$query = "SELECT * FROM i_indicador WHERE id = '$id'";
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
    <title>Información de Indicadores de Apoyo a la Infraestructura Informática</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/verIndi.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
    
</head>
<body>

    <main class='contenedor'>
        <h1>Información de Indicadores</h1>
        <h4>Apoyo a la Infraestructura Informática</h4>
        
        <section class='registro'>
            <h2>Información Encontrada</h2>
            <hr>
            
            <table class='info-tabla'>
                <tr><td>Clave de Registro:</td><td>{$row['Claveregis']}</td></tr>
                <tr><td>Fecha de Elaboración:</td><td>{$mes_formateado}</td></tr>
                <tr><td>Periodo:</td><td>{$periodo_formateado}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📊 Solicitud de Servicio - Atender las solicitudes Generadas Por el Usuario</div>
            <table class='info-tabla'>
                <tr><td>Solicitudes Atendidas:</td><td>{$row['SolicitudesAtendidas']}</td></tr>
                <tr><td>Solicitudes Generadas por el Usuario:</td><td>{$row['NumSolicitudes']}</td></tr>
                <tr><td>Porcentaje de solicitudes Atendidas:</td><td>{$row['PorSolicitudesAtendidas']}%</td></tr>
                <tr><td>Eventualidades Presentadas en el Mes:</td><td>{$row['EventualidadesMes']}</td></tr>
                <tr><td>Meta Esperada:</td><td class='texto-largo'>{$row['MetaEsperadaMB']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptMB']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaMB']}</td></tr>
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
                    <input type='hidden' name='tabla' value='i_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='i_indicador'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            
            <div class='links'>
                <a href='ConIndicador.php' class='btn'>Realizar Otra Consulta</a>
                <a href='InformaticaP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
            </div>
        </section>
        
    </main>
</body>
</html>
";

include "Cerrar.php";
?>