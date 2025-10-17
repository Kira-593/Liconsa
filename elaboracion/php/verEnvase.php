<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM e_envases_rotos  WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
       <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de Rotura de Envases</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verPDC.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información de Rotura de Envases y Pérdida de Producto</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                <tr><td>Producto Afectado (Indicador):</td><td>{$row['Indicador']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Litros Perdidos por Motivo de Rotura</strong></td></tr>
                
                <tr><td>Defecto de fabricación (DF):</td><td>{$row['DF']} Litros</td></tr>
                <tr><td>Manejo de canastilla (MC):</td><td>{$row['MC']} Litros</td></tr>
                <tr><td>De manera intencional (MI):</td><td>{$row['MI']} Litros</td></tr>
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td><strong>TOTAL de Litros Perdidos:</strong></td><td><strong>{$row['Total']} Litros</strong></td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <a href='ConEnvase.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>