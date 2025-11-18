<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM g_relacionesindustriales WHERE id = '$Mes'";
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
            <title>Informe Mensual de Relaciones Industriales</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verRelaciones.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe de Relaciones Industriales (Plantilla de Personal)</h1>
            <hr>
            <section class='registro'>
                <h2>Datos Registrados para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Resumen de la Plantilla</strong></td></tr>
                <tr><td>Número Total de Trabajadores:</td><td>{$row['NumeroTrabajadores']}</td></tr>
                <tr><td>Plazas Totalmente Ocupadas:</td><td>{$row['NumeroPlazasOcupadas']}</td></tr>
                <tr><td>Trabajadores de Confianza (Total):</td><td>{$row['TrabajadoresConfianza']}</td></tr>
                <tr><td>Trabajadores de Sindicato (Total):</td><td>{$row['TrabajadoresSindicato']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Desglose por Género y Contrato</strong></td></tr>
                
                <!-- Hombres -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2' style='text-indent: 10px;'>**Hombres (Total: {$row['TrabajadoresH']})**</td></tr>
                <tr><td style='text-indent: 10px;'>Hombres de Confianza:</td><td>{$row['HombresConfianza']}</td></tr>
                <tr><td style='text-indent: 10px;'>Hombres de Sindicato:</td><td>{$row['HombresSindicato']}</td></tr>
                
                <!-- Mujeres -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2' style='text-indent: 10px;'>**Mujeres (Total: {$row['TrabajadoresM']})**</td></tr>
                <tr><td style='text-indent: 10px;'>Mujeres de Confianza:</td><td>{$row['MujeresConfianza']}</td></tr>
                <tr><td style='text-indent: 10px;'>Mujeres de Sindicato:</td><td>{$row['MujeresSindicato']}</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>3. Novedades del Mes</strong></td></tr>

                <!-- Vacantes -->
                <tr><td>**Vacantes Existentes:**</td><td></td></tr>
                <tr><td colspan='2'>
                    <!-- textarea estilizado para verse como texto sin cuadro blanco -->
                    <textarea rows='4' readonly'>{$row['VacantesTV']}</textarea>
                </td></tr>

                <!-- Incapacidades -->
                <tr><td>**Incapacidades Registradas:**</td><td></td></tr>
                <tr><td colspan='2'>
                    <!-- textarea estilizado para verse como texto sin cuadro blanco -->
                    <textarea rows='4' readonly'>{$row['IncapacidadesTI']}</textarea>
                </td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            
                </table>
                <hr>
                <div class='links'>
                    <a href='ConRelaciones.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='gestionP.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='g_relacionesindustriales'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='g_relacionesindustriales'>
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