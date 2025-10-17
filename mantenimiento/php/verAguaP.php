<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM m_consumoaguaproceso  WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
      <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe Mensual de Consumo de Agua para Proceso</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/veraguap.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Consumo de Agua para Proceso (Pozo Profundo)</h1>
            <hr>
            <section class='registro'>
                <h2>Datos de Consumo Registrados para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>Consumo de Agua de Pozo Profundo</strong></td></tr>
                
                <tr><td>Consumo de Agua de pozo Profundo por Mes:</td><td>{$row['AguaPM']} M³/Mes</td></tr>
                <tr><td>Consumo de Agua de pozo Profundo Total Acumulado:</td><td>{$row['AguaPTA']} M³</td></tr>
                
                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarAguaP.php, ajustamos el enlace de consulta a ConAguaP.php -->
                    <a href='ConAguaP.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>