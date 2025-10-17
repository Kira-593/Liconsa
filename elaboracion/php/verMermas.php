<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM e_mermas WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de Mermas Mensuales</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verPDC.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información de Mermas de Productos Lácteos</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Detalle de Mermas por Tipo de Leche</strong></td></tr>
                
                <!-- Leche Frisia -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Leche Frisia</strong></td></tr>
                <tr><td>Cantidad de Merma (Kilos):</td><td>{$row['Leche_FrisiaK']} Kilos</td></tr>
                <tr><td>Porcentaje Total de Merma:</td><td>{$row['porcentajeTF']} %</td></tr>
                
                <!-- Leche de Abasto -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Leche de Abasto</strong></td></tr>
                <tr><td>Cantidad de Merma (Kilos):</td><td>{$row['Leche_Abasto']} Kilos</td></tr>
                <tr><td>Porcentaje Total de Merma:</td><td>{$row['porcentajeTA']} %</td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <a href='ConMermas.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>