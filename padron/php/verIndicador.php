<?php
include "Conexion.php";

// Obtener el ID del registro a consultar
$id = $_GET["id"] ?? $_GET["sc"] ?? '';

$query = "SELECT * FROM P_indicador WHERE id = '$id'";
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
    <title>Información de Indicadores del Padrón</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/verIndicador.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

    <div class='contenedor'>
        <h1>Información de Indicadores del Padrón</h1>
        <hr>
        
        <section class='registro'>
            <h2>Información Encontrada</h2>
            <hr>
            
            <table class='info-tabla'>
                <tr><td>ID del Registro:</td><td>{$row['id']}</td></tr>
                <tr><td>Clave de Registro:</td><td>{$row['Claveregis']}</td></tr>
                <tr><td>Fecha de Elaboración:</td><td>{$mes_formateado}</td></tr>
                <tr><td>Periodo:</td><td>{$periodo_formateado}</td></tr>
                <tr><td>Fecha de Registro:</td><td>" . date('d/m/Y H:i:s', strtotime($row['fecha_registro'])) . "</td></tr>
            </table>
            
            <div class='seccion-titulo'>📊 Meta de Beneficiarios</div>
            <table class='info-tabla'>
                <tr><td>Número de Beneficiarios:</td><td>{$row['NumBenefi']}</td></tr>
                <tr><td>Meta de Beneficiarios:</td><td>{$row['MetaBeneficiarios']}</td></tr>
                <tr><td>Meta Alcanzada:</td><td>{$row['MetaReal']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaMB']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptMB']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaMB']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🥛 Factor de Retiro Global Líquida</div>
            <table class='info-tabla'>
                <tr><td>Litros Vendidos:</td><td>{$row['LitrosVendidos']}</td></tr>
                <tr><td>Número de Beneficiarios Activos:</td><td>{$row['NumBenefiActivos']}</td></tr>
                <tr><td>Días de Venta:</td><td>{$row['DiasVenta']}</td></tr>
                <tr><td>Factor de Retiro Global Líquida:</td><td>{$row['FacRetLi']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaFRL']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptFRL']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaFRL']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🥛 Factor de Retiro Global Polvo</div>
            <table class='info-tabla'>
                <tr><td>Litros Vendidos:</td><td>{$row['LitrosVendidosPol']}</td></tr>
                <tr><td>Número de Beneficiarios Activos:</td><td>{$row['NumBenefiActivosPol']}</td></tr>
                <tr><td>Días de Venta:</td><td>{$row['DiasVentaPol']}</td></tr>
                <tr><td>Factor de Retiro Global Polvo:</td><td>{$row['FacRetPol']}</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaFRP']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptFRP']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaFRP']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>🎫 Tarjetas No Entregadas</div>
            <table class='info-tabla'>
                <tr><td>Número de Tarjetas No Entregadas:</td><td>{$row['TNE']}</td></tr>
                <tr><td>Número de Familias Inscritas:</td><td>{$row['FamiliasInscritas']}</td></tr>
                <tr><td>Porcentaje de Tarjetas No Entregadas:</td><td>{$row['PorcentajeTNE']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaTNE']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptTNE']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaTNE']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📝 Atención a Quejas</div>
            <table class='info-tabla'>
                <tr><td>Quejas Recibidas:</td><td>{$row['QuejasRecibidas']}</td></tr>
                <tr><td>Quejas Atendidas:</td><td>{$row['QuejasAtendidas']}</td></tr>
                <tr><td>Porcentaje de Quejas Atendidas:</td><td>{$row['PQNA']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaAQ']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptAQ']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaAQ']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>📋 Encuesta de Satisfacción al Cliente</div>
            <table class='info-tabla'>
                <tr><td>Total de Encuestas:</td><td>{$row['TotalEncues']}</td></tr>
                <tr><td>Máximo de Puntos:</td><td>{$row['MaxPuntos']}</td></tr>
                <tr><td>Total de Puntos del Total de Encuestas:</td><td>{$row['TPTE']}</td></tr>
                <tr><td>Porcentaje de Encuestas de Satisfacción:</td><td>{$row['PorcentajeEncuestas']}%</td></tr>
                <tr><td>Meta Esperada:</td><td>{$row['MetaEsperadaES']}</td></tr>
                <tr><td>Rango de Aceptación:</td><td>{$row['RangoAceptES']}</td></tr>
                <tr><td>Tendencia Deseada:</td><td>{$row['TendenciaDeseadaES']}</td></tr>
            </table>
            
            <div class='seccion-titulo'>👤 Información Adicional</div>
            <table class='info-tabla'>
                <tr><td>Responsable:</td><td>{$row['Responsable']}</td></tr>
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
                    <input type='hidden' name='tabla' value='p_indicador'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='p_indicador'>
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