<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM m_consumo_energia_produccion  WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
       
           <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe Mensual de Consumo de Energía y Producción</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/vercons.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Producción y Consumo Mensual (Energía y Diesel)</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Producción Total de Leche</strong></td></tr>
                <tr><td>Producción de Leche Total Mensual:</td><td>{$row['ProduccionLecheTP']} Litros</td></tr>
                <tr><td>Variación ITR (Reducción (-) / Incremento (+)):</td><td>{$row['ReduccionITR_Leche']} %</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Consumo de Energía Eléctrica</strong></td></tr>
                <tr><td>Energía Eléctrica Total Mensual:</td><td>{$row['EnergiaElectricaTE']} kW/hr</td></tr>
                <tr><td>Energía Eléctrica Total Mensual (GJ):</td><td>{$row['EnergiaElectricaTEG']} GJ</td></tr>
                <tr><td>Variación ITR (Reducción (-) / Incremento (+)):</td><td>{$row['ReduccionITR_Energia']} %</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>3. Consumo de Diesel</strong></td></tr>
                <tr><td>Consumo de Diesel Total Mensual:</td><td>{$row['ConsumoDieselTP']} Litros</td></tr>
                <tr><td>Consumo de Diesel Total Mensual (GJ):</td><td>{$row['ConsumoDieselTPG']} GJ</td></tr>
                <tr><td>Variación ITR (Reducción (-) / Incremento (+)):</td><td>{$row['ReduccionITR_Diesel']} %</td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <a href='ConCons.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>