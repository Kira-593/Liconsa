<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM m_consumo_energia_termica_electrica  WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    $texto_modificar = $row['permitir_modificar'] ? 'Bloquear Modificación' : 'Permitir Modificar';
    $texto_firmar = $row['permitir_firmar'] ? 'Bloquear Firma' : 'Permitir Firmar';

    // Determinar las clases CSS para los botones
    $clase_modificar = $row['permitir_modificar'] ? 'btn btn-warning' : 'btn btn-success';
    $clase_firmar = $row['permitir_firmar'] ? 'btn btn-warning' : 'btn btn-success';


   echo "
        <<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe Mensual de Consumo de Energía Térmica y Eléctrica</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/vercons.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe Mensual de Consumo de Energía Térmica y Eléctrica</h1>
            <hr>
            <section class='registro'>
                <h2>Datos de Consumo Registrados para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Consumo de Energía Térmica (Diesel)</strong></td></tr>
                
                <tr><td>Cantidad de Litros de Diesel consumidos:</td><td>{$row['CantidadDieselCTC']} Litros</td></tr>
                <tr><td>Var. vs Año Anterior (Reducción(-)/Incremento(+)):</td><td>{$row['ReduccionITD']} %</td></tr>
                <tr><td>Promedio de Reducción o Incremento:</td><td>{$row['PromedioRID']} %</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>

                <tr><td>Litros de Diesel por Litro de Leche (DLL):</td><td>{$row['LitrosDLL']} Litros/Litro</td></tr>
                <tr><td>Var. DLL vs Año Anterior (Reducción(-)/Incremento(+)):</td><td>{$row['ReduccionILD']} %</td></tr>
                <tr><td>Promedio Var. DLL:</td><td>{$row['PromedioRILD']} %</td></tr>

                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Consumo de Energía Eléctrica</strong></td></tr>
                
                <tr><td>Cantidad de Energía Eléctrica consumida:</td><td>{$row['CantidadEnergiaCTC']} Kw/hr</td></tr>
                <tr><td>Var. vs Año Anterior (Reducción(-)/Incremento(+)):</td><td>{$row['ReduccionITR']} %</td></tr>
                <tr><td>Promedio de Reducción o Incremento:</td><td>{$row['PromedioRIT']} %</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>

                <tr><td>Kw por Litro de Leche (Kw/LLT):</td><td>{$row['CantidadLLT']} Kw/Litro</td></tr>
                <tr><td>Var. Kw/LLT vs Año Anterior (Reducción(-)/Incremento(+)):</td><td>{$row['ReduccionIKL']} %</td></tr>
                <tr><td>Promedio Var. Kw/LLT:</td><td>{$row['PromedioRIK']} %</td></tr>

                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
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
                <div class='links'>
                    <!-- El formulario de guardado sugiere GuardarConsEnergia.php, el de consulta debe ser similar -->
                    <a href='ConConsEnergia.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                 <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='m_consumo_energia_termica_electrica'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='m_consumo_energia_termica_electrica'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
                </div>
            </section>
            </div>
        </body>
        </html>

    ";
    include "Cerrar.php";
?>