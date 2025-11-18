<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_captacionleche WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

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
            <title>Informe de Recepción y Control de Leche (RCT)</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verRCT.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Captación y Control de Leche</h1>
            <hr>
            <section class='registro'>
                <h2>Detalle del Dictamen Técnico</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Información General de Recepción</strong></td></tr>
                <tr><td>Proveedor:</td><td>{$row['Proveedor']}</td></tr>
                <tr><td>Folio de Control:</td><td>{$row['Folio']}</td></tr>
                <tr><td>Fecha de Dictamen:</td><td>{$row['FechaDictamen']}</td></tr>
                <tr><td>Remisión:</td><td>{$row['Remision']}</td></tr>
                <tr><td>Volumen Recibido:</td><td>{$row['Volumen']} Litros</td></tr>

                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Resultados Físicoquímicos</strong></td></tr>
                
                <tr><td>Densidad:</td><td>{$row['Densidad']} g/mL</td></tr>
                <tr><td>Grasa:</td><td>{$row['Grasa']} g/L</td></tr>
                <tr><td>Sólidos No Grasos (S.N.G.):</td><td>{$row['SNG']} g/L</td></tr>
                <tr><td>Proteína:</td><td>{$row['Proteina']} g/L</td></tr>
                <tr><td>Caseína:</td><td>{$row['Caseina']} g/L</td></tr>
                <tr><td>Acidez:</td><td>{$row['Acidez']} g/L</td></tr>
                <tr><td>Punto Crioscópico (°H):</td><td>{$row['PH']}</td></tr>
                <tr><td>Temperatura:</td><td>{$row['Temperatura']} °C</td></tr>
                <tr><td>Reductasa:</td><td>{$row['Reductasa']} min</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            
                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarRCT.php, el enlace de consulta se ajusta a ConRCT.php -->
                    <a href='ConRCT.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='c_captacionleche'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='c_captacionleche'>
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