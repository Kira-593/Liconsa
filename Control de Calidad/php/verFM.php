<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_formulariofm WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
      <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe Mensual de Cantidad de Análisis (FM)</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verFM.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Análisis de Laboratorio (FM)</h1>
            <hr>
            <section class='registro'>
                <h2>Datos Registrados</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                <tr><td>Tipo de Análisis (Indicador):</td><td><strong>{$row['Indicador']}</strong></td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Detalle de la Cantidad de Análisis Realizados</strong></td></tr>
                
                <tr><td>Análisis de Insumos:</td><td>{$row['Cantidad_insumos']}</td></tr>
                <tr><td>Análisis de Productos Terminados:</td><td>{$row['ProductosT']}</td></tr>
                <tr><td>Controles Diversos:</td><td>{$row['ControlesD']}</td></tr>
                <tr><td>Análisis de Materiales Auxiliares:</td><td>{$row['MaterialesA']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td><strong>Total de Análisis Realizados:</strong></td><td><strong>{$row['Total']}</strong></td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarFM.php, el enlace de consulta se ajusta a ConFM.php -->
                    <a href='ConFM.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>

    ";
    include "Cerrar.php";
?>