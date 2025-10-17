<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_evaluaciondesempeno WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
     <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Informe de Evaluación del Desempeño Mensual</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <!-- Puedes mantener el CSS que uses para los informes, aunque lo he renombrado genéricamente aquí -->
            <link rel='stylesheet' href='../css/verFM.css'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Evaluación del Desempeño</h1>
            <hr>
            <section class='registro'>
                <h2>Resultados de Cumplimiento</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td>Mes de Evaluación:</td><td><strong>{$row['Mes']}</strong></td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>1. Métricas de Servicio y Desempeño</strong></td></tr>
                
                <tr><td>Servicios Totales Solicitados:</td><td>{$row['ServiciosSTS']} No.Serv.</td></tr>
                <tr><td>Servicios Atendidos en Tiempo:</td><td>{$row['ServiciosATS']} No.Serv.</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Indicadores Clave</strong></td></tr>
                
                <tr><td>**Porcentaje de Cumplimiento (Calculado):**</td><td><strong>{$row['PorcentajeCTP']}</strong></td></tr>
                <tr><td>Meta Mínima Requerida:</td><td>{$row['MetaTM']}%</td></tr>

                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarEva.php, el enlace de consulta se ajusta a ConEva.php -->
                    <a href='ConEvaluacion.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
            </section>
            </div>
        </body>
        </html>

    ";
    include "Cerrar.php";
?>