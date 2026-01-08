<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM e_subgerencia_operaciones WHERE id = '$Mes'";
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
            <title>Informe Mensual de Sólidos Grasos y Producción</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
            <link rel='stylesheet' href='../css/verSubG.css'>
            <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
            <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
        </head>
        <body>

            <div class='contenedor'>
            <h1>Informe Mensual de Sólidos Grasos (SG) y Producción Láctea</h1>
            <hr>
            <section class='registro'>
                <h2>Datos Encontrados para el Mes: {$row['Mes']}</h2>
                <hr>
                <table class='info-tabla'>
                
                <tr><td colspan='2'><strong>1. Sólidos en Leche Fresca de Recepción</strong></td></tr>
                <tr><td>Litros de Leche Fresca en Recepción:</td><td>{$row['LitrosFres']} Litros</td></tr>
                <tr><td>Sólidos Grasos (SG) Promedio:</td><td>{$row['SHp']} %</td></tr>
                <tr><td>Sólidos No Grasos (SNG) Promedio:</td><td>{$row['SNGp']} %</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>2. Leche Abasto Social</strong></td></tr>
                <tr><td>Volumen Total:</td><td>{$row['volumenTA']} Litros</td></tr>
                <tr><td>Sólidos Grasos en Producto Terminado:</td><td>{$row['solidosTA']} Gramos/Litro</td></tr>

                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>3. Leche Comercial Frisia</strong></td></tr>
                <tr><td>Volumen Total:</td><td>{$row['VolumenTC']} Litros</td></tr>
                <tr><td>Porcentaje Total de Leche Fresca Utilizada:</td><td>{$row['TotalTC']} %</td></tr>
                <tr><td>Contenido de Sólidos Grasos en Producto Terminado:</td><td>{$row['ContenidoTC']} Gramos/Litro</td></tr>

                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>4. Producción de Abasto Social</strong></td></tr>
                <tr><td>Volumen Total de Producción:</td><td>{$row['VolumenTP']} Litros</td></tr>
                <tr><td>Leche Fresca Usada para Abasto Social:</td><td>{$row['LecheTP']} Litros</td></tr>
                <tr><td>Porcentaje de Leche Fresca Utilizada:</td><td>{$row['PorsentajeTP']} %</td></tr>
                <tr><td>Producción con LPD Estandarizado:</td><td>{$row['ProduccionTP']} Litros</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>5. Aprovechamiento de Capacidad de Producción</strong></td></tr>
                <tr><td>Días Operativos del Mes:</td><td>{$row['DiasOTD']} Días</td></tr>
                <tr><td>Capacidad Instalada Estandar de Máquina:</td><td>{$row['CapacidadITC']} Litros/Día</td></tr>
                <tr><td>Total Capacidad Instalada por Mes:</td><td>{$row['TotalCapacidad']} Litros</td></tr>
                <tr><td>Producción Total Abasto Social:</td><td>{$row['ProduccionATP']} Litros</td></tr>
                <tr><td>Producción Total Leche Frisia:</td><td>{$row['ProduccionFTP']} Litros</td></tr>
                <tr><td>Total de Producción por Mes:</td><td>{$row['TotalProduccion']} Litros</td></tr>
                
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>6. Consumo de Químicos para Limpieza (CIP)</strong></td></tr>
                <tr><td>Días Operativos Acumulados hasta el Mes:</td><td>{$row['DiasATD']} Días</td></tr>
                
                <!-- Hidróxido de Sodio -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2' style='text-indent: 10px;'>**Hidróxido de Sodio**</td></tr>
                <tr><td style='text-indent: 10px;'>Consumo Mensual:</td><td>{$row['HidroxidoTH']} Kg/Mes</td></tr>
                <tr><td style='text-indent: 10px;'>Total Anual Acumulado:</td><td>{$row['TotalATT_Hidroxido']} Kg</td></tr>
                <tr><td style='text-indent: 10px;'>Consumo Diario Acumulado:</td><td>{$row['AcumuladoCTA_Hidroxido']} Kg</td></tr>

                <!-- Ácido Fosfórico -->
                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2' style='text-indent: 10px;'>**Ácido Fosfórico**</td></tr>
                <tr><td style='text-indent: 10px;'>Consumo Mensual:</td><td>{$row['AcidoFTA']} Kg/Mes</td></tr>
                <tr><td style='text-indent: 10px;'>Total Anual Acumulado:</td><td>{$row['TotalATT_Acido']} Kg</td></tr>
                <tr><td style='text-indent: 10px;'>Consumo Diario Acumulado:</td><td>{$row['AcumuladoCTA_Acido']} Kg</td></tr>

                <tr><td colspan='2'>&nbsp;</td></tr>
                <tr><td colspan='2'><strong>Estado de Permisos</strong></td></tr>
                <tr><td>Permitir Modificar:</td><td>" . ($row['permitir_modificar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
                <tr><td>Permitir Firmar:</td><td>" . ($row['permitir_firmar'] ? '✅ ACTIVADO' : '❌ DESACTIVADO') . "</td></tr>
            
                </table>

                     " . (!empty($row['firma_usuario']) ? "
                <div class='seccion-titulo'>📝 Estado de Firma</div>
                <table class='info-tabla'>
                    <tr><td>Documento Firmado por:</td><td>{$row['firma_usuario']}</td></tr>
                    <tr><td>Fecha de Firma:</td><td>" . date('d/m/Y H:i:s', strtotime($row['fecha_firma'])) . "</td></tr>
                </table>
                " : "") . "
                
                <hr>
                <div class='links'>
                    <a href='ConSubG.php' class='btn'>Realizar Otra Consulta</a>
                    <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
                </div>
                <div class='links'>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='modificar'>
                    <input type='hidden' name='tabla' value='e_subgerencia_operaciones'>
                    <input type='submit' class='$clase_modificar' value='$texto_modificar'>
                </form>
                <form method='post' action='GestionarPermisos.php' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='accion' value='firmar'>
                    <input type='hidden' name='tabla' value='e_subgerencia_operaciones'>
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