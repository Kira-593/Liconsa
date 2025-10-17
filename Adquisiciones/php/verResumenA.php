<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_resumenadquisiciones WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
     <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe de Resumen de Adquisiciones Mensual</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <!-- Puedes mantener el CSS que uses para los informes, aunque lo he renombrado genéricamente aquí -->
            <link rel='stylesheet' href='../css/verFM.css'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Resumen Mensual de Adquisiciones</h1>
            <hr>
            <section class='registro'>
                <h2>Detalle de Bienes y Servicios</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Identificación y Periodo</strong></td></tr>
                <tr><td>Mes de Registro:</td><td><strong>{$row['Mes']}</strong></td></tr>
                <tr><td>Código de Adquisición (CodigoTC):</td><td>{$row['CodigoTC']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Detalles de la Adquisición</strong></td></tr>
                
                <tr><td>Descripción de Bienes y/o Servicios (DescripcionBTD):</td><td>{$row['DescripcionBTD']}</td></tr>
                <tr><td>Monto Sin IVA (MontoSIT):</td><td>$ {$row['MontoSIT']}</td></tr>
                <tr><td>Fundamento Legal (LPAD):</td><td>{$row['LPAD']}</td></tr>
                <tr><td>Empresa Adjudicada (EmpresaATE):</td><td>{$row['EmpresaATE']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>3. Total de la Gerencia</strong></td></tr>
                
                <tr><td>**Total Gerencia Estatal Tlaxcala (GET):**</td><td><strong>$ {$row['TotalGET']}</strong></td></tr>

                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarResumenA.php, el enlace de consulta se ajusta a ConResumenA.php -->
                    <a href='ConResumenA.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='AdquisicionesP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>

    ";
    include "Cerrar.php";
?>