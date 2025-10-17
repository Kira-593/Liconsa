<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM p_subgerenciaabasto WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información del Padrón Mensual</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verSubg.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información del Padrón Mensual</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Hogares y Beneficiarios Atendidos</strong></td></tr>
                <tr><td>Meta Establecida Para este mes:</td><td>{$row['MetaETM']}</td></tr>
                <tr><td>Cantidad de Derechohabientes:</td><td>{$row['CantidadDTC']}</td></tr>
                <tr><td>Cantidad de Familias:</td><td>{$row['CantidadFTC']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Cantidad de Integrantes del Padrón</strong></td></tr>
                <tr><td>Niñas y Niños de 6 a 12 Años (TB1):</td><td>{$row['TBuno']} ({$row['Porcentajebuno']}%)</td></tr>
                <tr><td>Mujeres en Periodo de Gestación (TB2):</td><td>{$row['TBdos']} ({$row['Porcentajetbdos']}%)</td></tr>
                <tr><td>Enfermos Crónicos o Con Discapacidad (TB3):</td><td>{$row['TBtres']} ({$row['Porcentajetbtres']}%)</td></tr>
                <tr><td>Adultos Mayores de 60 Años (TB4):</td><td>{$row['TBCuatro']} ({$row['Porcentajetbcuatro']}%)</td></tr>
                <tr><td>Adolescentes de 13 a 19 Años (TB5):</td><td>{$row['TBCinco']} ({$row['Porcentajetbcinco']}%)</td></tr>
                <tr><td>Mujeres en Periodo de Lactancia (TB6):</td><td>{$row['TBseis']} ({$row['Porcentajetbseis']}%)</td></tr>
                <tr><td>Mujeres de 45 Años en Adelante (TB7):</td><td>{$row['TBsiete']} ({$row['Porcentajetbsiete']}%)</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Bajas y Altas al Padrón</strong></td></tr>
                <tr><td>Bajas registradas este mes:</td><td>{$row['BajasTB']}</td></tr>
                <tr><td>Altas registradas este mes:</td><td>{$row['AltasTA']}</td></tr>
                <tr><td>Variación del mes:</td><td>{$row['VariacionTV']}</td></tr>
                </table>
                <hr>
                <div class='links'>
                    <a href='ConSub.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>