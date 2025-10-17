<?php
    include "Conexion.php";

    $Mes = $_GET["sc"];

    $query = "SELECT * FROM  con_deptocontabilidad WHERE id = '$Mes'";
    $res = mysqli_query($link, $query);
    $row = mysqli_fetch_array($res);

   echo "
      <!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Información del Depto. de Contabilidad</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/verContabilidad.css'>
    <img src='../imagenes/AgriculturaLogo.png' class='logo-superior' alt='Logo Agricultura'>
    <img src='../imagenes/sgc.png' class='logo-sgc' alt='Logo SGC'>
</head>
<body>

<div class='contenedor'>
    <h1>Información del Depto. de Contabilidad</h1>
    <hr>
    <section class='registro'>
        <h2>Información Encontrada</h2>
        <hr>

        <table class='info-tabla'>
            <tr><td>Mes:</td><td>{$row['Mes']}</td></tr>

            <tr><td colspan='2'><strong>Servicios Personales</strong></td></tr>
            <tr><td>Presupuesto Comprometido (Mano de Obra):</td><td>{$row['ComprometidoMAOB']}</td></tr>
            <tr><td>Presupuesto Disponible (Mano de Obra):</td><td>{$row['DisponibleMAOB']}</td></tr>
            <tr><td>Presupuesto Comprometido (Empleados de Confianza):</td><td>{$row['ComprometidoEMCO']}</td></tr>
            <tr><td>Presupuesto Disponible (Empleados de Confianza):</td><td>{$row['DisponibleEMCO']}</td></tr>
            <tr><td>Presupuesto Comprometido (Empleados Eventuales):</td><td>{$row['ComprometidoEMEV']}</td></tr>
            <tr><td>Presupuesto Disponible (Empleados Eventuales):</td><td>{$row['DisponibleEMEV']}</td></tr>
            <tr><td>Total Comprometido Servicios Personales:</td><td>{$row['TPCSEPE']}</td></tr>
            <tr><td>Total Disponible Servicios Personales:</td><td>{$row['TPDSEPE']}</td></tr>

            <tr><td colspan='2'><strong>Materiales y Suministros</strong></td></tr>
            <tr><td>Presupuesto Comprometido (Prestaciones en Especie):</td><td>{$row['ComprometidoPRES']}</td></tr>
            <tr><td>Presupuesto Disponible (Prestaciones en Especie):</td><td>{$row['DisponiblePRES']}</td></tr>
            <tr><td>Presupuesto Comprometido (Materiales de Operación):</td><td>{$row['ComprometidoMAOP']}</td></tr>
            <tr><td>Presupuesto Disponible (Materiales de Operación):</td><td>{$row['DisponibleMAOP']}</td></tr>
            <tr><td>Total Comprometido Materiales y Suministros:</td><td>{$row['TPCMASU']}</td></tr>
            <tr><td>Total Disponible Materiales y Suministros:</td><td>{$row['TPDMASU']}</td></tr>

            <tr><td colspan='2'><strong>Servicios Generales</strong></td></tr>
            <tr><td>Presupuesto Comprometido (Prestaciones en Empleados):</td><td>{$row['ComprometidoPREM']}</td></tr>
            <tr><td>Presupuesto Disponible (Prestaciones en Empleados):</td><td>{$row['DisponiblePREM']}</td></tr>
            <tr><td>Presupuesto Comprometido (Mantenimiento y Conservación):</td><td>{$row['ComprometidoMACO']}</td></tr>
            <tr><td>Presupuesto Disponible (Mantenimiento y Conservación):</td><td>{$row['DisponibleMACO']}</td></tr>
            <tr><td>Presupuesto Comprometido (Impuestos y Derechos):</td><td>{$row['ComprometidoIMDE']}</td></tr>
            <tr><td>Presupuesto Disponible (Impuestos y Derechos):</td><td>{$row['DisponibleIMDE']}</td></tr>
            <tr><td>Presupuesto Comprometido (Seguros y Finanzas):</td><td>{$row['ComprometidoSEFI']}</td></tr>
            <tr><td>Presupuesto Disponible (Seguros y Finanzas):</td><td>{$row['DisponibleSEFI']}</td></tr>
            <tr><td>Presupuesto Comprometido (Servicios Básicos, Asesorías y Consultas):</td><td>{$row['ComprometidoSERBA']}</td></tr>
            <tr><td>Presupuesto Disponible (Servicios Básicos, Asesorías y Consultas):</td><td>{$row['DisponibleSERBA']}</td></tr>
            <tr><td>Presupuesto Comprometido (Transportación):</td><td>{$row['ComprometidoTRAN']}</td></tr>
            <tr><td>Presupuesto Disponible (Transportación):</td><td>{$row['DisponibleTRAN']}</td></tr>
            <tr><td>Presupuesto Comprometido (Gastos por Reuniones y Comités):</td><td>{$row['ComprometidoGARE']}</td></tr>
            <tr><td>Presupuesto Disponible (Gastos por Reuniones y Comités):</td><td>{$row['DisponibleGARE']}</td></tr>
            <tr><td>Total Comprometido Servicios Generales:</td><td>{$row['TPCSEGE']}</td></tr>
            <tr><td>Total Disponible Servicios Generales:</td><td>{$row['TPDSEGE']}</td></tr>

            <tr><td colspan='2'><strong>Ventas, Costos, Gastos, Pérdidas o Utilidad</strong></td></tr>
            <tr><td>Recursos Fiscales Mensuales (Se Recibió):</td><td>{$row['ComprometidoVentas']}</td></tr>
            <tr><td>Observaciones:</td><td>{$row['ObservacionesVentas']}</td></tr>

            <tr><td colspan='2'><strong>Concentrado de Costo y Fijo Mensuales</strong></td></tr>
            <tr><td>Costo Variable - Leche Fluida Tipo A-RG:</td><td>{$row['CostoVLF']}</td></tr>
            <tr><td>Costo Fijo - Leche Fluida Tipo A-RG:</td><td>{$row['CostoFLF']}</td></tr>
            <tr><td>Costo Variable - Mezcla de Leche Tipo B-RG:</td><td>{$row['CostoVMG']}</td></tr>
            <tr><td>Costo Fijo - Mezcla de Leche Tipo B-RG:</td><td>{$row['CostoFMG']}</td></tr>
            <tr><td>Costo Variable - Leche 'Frisia':</td><td>{$row['CostoVLFRI']}</td></tr>
            <tr><td>Costo Fijo - Leche 'Frisia':</td><td>{$row['CostoFLFRI']}</td></tr>
        </table>

        <hr>
        <div class='links'>
            <a href='ConContabilidad.php' class='btn'>Realizar Otra Consulta</a>
            <a href='MenuConsulta.php' class='home-link'><img src='../imagenes/home.png' alt='Inicio' height='50' width='50'></a>
        </div>
    </section>
</div>
</body>
</html>

    ";
    include "Cerrar.php";
?>