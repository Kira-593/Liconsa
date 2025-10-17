<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_contenidonetopesoenvase WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
      <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe de Contenido Neto y Peso de Envase (NyP)</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verFM.css'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Control de Llenado (Contenido Neto y Envase)</h1>
            <hr>
            <section class='registro'>
                <h2>Datos Registrados para el Producto: {$row['Indicador']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td>Mes de Registro:</td><td><strong>{$row['Mes']}</strong></td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>1. CONTENIDO NETO (Volumen de Llenado)</strong></td></tr>
                
                <tr><td>Valor Mínimo (MinimoTMN):</td><td>{$row['MinimoTMN']} ml</td></tr>
                <tr><td>Valor Máximo (MaximoTMN):</td><td>{$row['MaximoTMN']} ml</td></tr>
                <tr><td>**Promedio de Llenado (PromedioTPN):**</td><td><strong>{$row['PromedioTPN']} ml</strong></td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. PESO DEL ENVASE VACÍO</strong></td></tr>
                
                <tr><td>Peso Mínimo (MinimoTE):</td><td>{$row['MinimoTE']} gr</td></tr>
                <tr><td>Peso Máximo (MaximoTE):</td><td>{$row['MaximoTE']} gr</td></tr>
                <tr><td>**Peso Promedio del Envase (PromedioTP):**</td><td><strong>{$row['PromedioTP']} gr</strong></td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarNyP.php, el enlace de consulta se ajusta a ConNyP.php -->
                    <a href='ConContenidoNyP.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>

    ";
    include "Cerrar.php";
?>