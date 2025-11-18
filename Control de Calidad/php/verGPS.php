<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  c_formulariogps WHERE id = '$Mes'";
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
            <title>Informe de Determinación de Componentes (GPS)</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verFM.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Determinación de Componentes Químicos</h1>
            <hr>
            <section class='registro'>
                <h2>Datos Registrados para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Identificación de la Determinación</strong></td></tr>
                <tr><td>Tipo de Determinación (Indicador):</td><td><strong>{$row['Indicador']}</strong></td></tr>
                <tr><td>Método Utilizado:</td><td>{$row['Metodo']}</td></tr>
                <tr><td>Muestra Analizada:</td><td>{$row['Muestra']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Resultados y Parámetros de Control</strong></td></tr>
                
                <tr><td>Valor de Referencia:</td><td>{$row['ValorR']}</td></tr>
                <tr><td>Valor Máximo Permitido:</td><td>{$row['ValorMax']}</td></tr>
                <tr><td>Valor Mínimo Permitido:</td><td>{$row['ValorMin']}</td></tr>
                <tr><td>**Promedio Mensual (Unidades):**</td><td><strong>{$row['UnidadesKG']}</strong></td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            
                </table>
                <hr>
                <div class='links'>
                    <!-- El formulario de guardado es GuardarGPS.php, el enlace de consulta se ajusta a ConGPS.php -->
                    <a href='ConGPS.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='c_formulariogps'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='c_formulariogps'>
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