<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  p_rutasdistribucion WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información del Transporte Propio</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verrutas.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información de Litros Desplazados (Transporte Propio)</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Transporte Propio - Rutas Desplazadas</strong></td></tr>
                
                <tr><td>Litros Desplazados de R1:</td><td>{$row['LitrosTRuno']} ({$row['PorcentajeTRuno']}%)</td></tr>
                <tr><td>Litros Desplazados de R2:</td><td>{$row['LitrosTRdos']} ({$row['PorcentajeTRdos']}%)</td></tr>
                <tr><td>Litros Desplazados de R3:</td><td>{$row['LitrosTRtres']} ({$row['PorcentajeTRtres']}%)</td></tr>
                <tr><td>Litros Desplazados de R4:</td><td>{$row['LitrosTRcuatro']} ({$row['PorcentajeTRcuatro']}%)</td></tr>

                </table>
                <hr>
                <div class='links'>
                    <a href='ConRutas.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>