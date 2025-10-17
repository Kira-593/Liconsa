<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  a_existenciasmaterial WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
       <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de Inventario de Materiales</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/vermaterial.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información de Inventario de Materiales</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                <tr><td>Tipo de Inventario (Indicador):</td><td>{$row['Indicador']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Detalle del Material</strong></td></tr>
                <tr><td>Código:</td><td>{$row['CodigoTC']}</td></tr>
                <tr><td>Descripción:</td><td>{$row['DescripcionTD']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Movimiento de Cantidades (en Kg)</strong></td></tr>
                <tr><td>Cantidad Inicial:</td><td>{$row['CantidadITC']}</td></tr>
                <tr><td>Cantidad de Entradas:</td><td>{$row['CantidadETC']}</td></tr>
                <tr><td>Cantidad de Consumo:</td><td>{$row['CantidadCTC']}</td></tr>
                <tr><td>Cantidad Final:</td><td>{$row['CantidadFTC']}</td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <a href='ConMaterial.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>