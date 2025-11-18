<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM p_distribucionleche WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

    // Determinar el texto de los botones según el estado actual
$texto_modificar = $row['permitir_modificar'] ? 'Bloquear Modificación' : 'Permitir Modificar';
$texto_firmar = $row['permitir_firmar'] ? 'Bloquear Firma' : 'Permitir Firmar';

// Determinar las clases CSS para los botones
$clase_modificar = $row['permitir_modificar'] ? 'btn btn-warning' : 'btn btn-success';
$clase_firmar = $row['permitir_firmar'] ? 'btn btn-warning' : 'btn btn-success';

   echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Información de Distribución Mensual</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verDis.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Información de la Distribución de Leche</h1>
            <hr>
            <section class='registro'>
                <h2>Información Encontrada</h2>
                <hr>
                <table class='info-tabla'>
                <tr><td>Tipo de Leche (Indicador):</td><td>{$row['Indicador']}</td></tr>
                <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Meta vs. Alcance de Distribución</strong></td></tr>
                <tr><td>Meta de Distribución del Mes:</td><td>{$row['MetaTM']}</td></tr>
                <tr><td>Alcance de la Distribución del Mes:</td><td>{$row['AlcanceTA']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            
                </table>
                <hr>
                <div class='links'>
                    <a href='ConDis.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='p_distribucionleche'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='p_distribucionleche'>
                    <input type='submit' class='$clase_firmar' value='$texto_firmar'>
                </form>
            </div>
            </section>
            </div>
        </body>
        </html>
    ";
    include "Cerrar.php";
?>