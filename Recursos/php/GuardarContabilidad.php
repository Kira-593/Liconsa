<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    
    // Servicios Personales
    $ComprometidoMAOB = $_POST["ComprometidoMAOB"];
    $DisponibleMAOB = $_POST["DisponibleMAOB"];
    $ComprometidoEMCO = $_POST["ComprometidoEMCO"];
    $DisponibleEMCO = $_POST["DisponibleEMCO"];
    $ComprometidoEMEV = $_POST["ComprometidoEMEV"];
    $DisponibleEMEV = $_POST["DisponibleEMEV"];
    $TPCSEPE = $_POST["TPCSEPE"];
    $TPDSEPE = $_POST["TPDSEPE"];
    
    // Materiales y Suministros
    $ComprometidoPRES = $_POST["ComprometidoPRES"];
    $DisponiblePRES = $_POST["DisponiblePRES"];
    $ComprometidoMAOP = $_POST["ComprometidoMAOP"];
    $DisponibleMAOP = $_POST["DisponibleMAOP"];
    $TPCMASU = $_POST["TPCMASU"];
    $TPDMASU = $_POST["TPDMASU"];
    
    // Servicios Generales
    $ComprometidoPREM = $_POST["ComprometidoPREM"];
    $DisponiblePREM = $_POST["DisponiblePREM"];
    $ComprometidoMACO = $_POST["ComprometidoMACO"];
    $DisponibleMACO = $_POST["DisponibleMACO"];
    $ComprometidoIMDE = $_POST["ComprometidoIMDE"];
    $DisponibleIMDE = $_POST["DisponibleIMDE"];
    $ComprometidoSEFI = $_POST["ComprometidoSEFI"];
    $DisponibleSEFI = $_POST["DisponibleSEFI"];
    $ComprometidoSERBA = $_POST["ComprometidoSERBA"];
    $DisponibleSERBA = $_POST["DisponibleSERBA"];
    $ComprometidoTRAN = $_POST["ComprometidoTRAN"];
    $DisponibleTRAN = $_POST["DisponibleTRAN"];
    $ComprometidoGARE = $_POST["ComprometidoGARE"];
    $DisponibleGARE = $_POST["DisponibleGARE"];
    $TPCSEGE = $_POST["TPCSEGE"];
    $TPDSEGE = $_POST["TPDSEGE"];
    
    // Ventas, Costos, Gastos
    $ComprometidoVentas = $_POST["ComprometidoVentas"];
    $ObservacionesVentas = $_POST["ObservacionesVentas"];
    
    // Concentrado de Costo
    $CostoVLF = $_POST["CostoVLF"];
    $CostoFLF = $_POST["CostoFLF"];
    $CostoVMG = $_POST["CostoVMG"];
    $CostoFMG = $_POST["CostoFMG"];
    $CostoVLFRI = $_POST["CostoVLFRI"];
    $CostoFLFRI = $_POST["CostoFLFRI"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO con_deptocontabilidad (
        Mes, ComprometidoMAOB, DisponibleMAOB, ComprometidoEMCO, DisponibleEMCO, 
        ComprometidoEMEV, DisponibleEMEV, TPCSEPE, TPDSEPE, ComprometidoPRES, 
        DisponiblePRES, ComprometidoMAOP, DisponibleMAOP, TPCMASU, TPDMASU, 
        ComprometidoPREM, DisponiblePREM, ComprometidoMACO, DisponibleMACO, 
        ComprometidoIMDE, DisponibleIMDE, ComprometidoSEFI, DisponibleSEFI, 
        ComprometidoSERBA, DisponibleSERBA, ComprometidoTRAN, DisponibleTRAN, 
        ComprometidoGARE, DisponibleGARE, TPCSEGE, TPDSEGE, ComprometidoVentas, 
        ObservacionesVentas, CostoVLF, CostoFLF, CostoVMG, CostoFMG, CostoVLFRI, CostoFLFRI
    ) VALUES (
        '$Mes', '$ComprometidoMAOB', '$DisponibleMAOB', '$ComprometidoEMCO', '$DisponibleEMCO',
        '$ComprometidoEMEV', '$DisponibleEMEV', '$TPCSEPE', '$TPDSEPE', '$ComprometidoPRES',
        '$DisponiblePRES', '$ComprometidoMAOP', '$DisponibleMAOP', '$TPCMASU', '$TPDMASU',
        '$ComprometidoPREM', '$DisponiblePREM', '$ComprometidoMACO', '$DisponibleMACO',
        '$ComprometidoIMDE', '$DisponibleIMDE', '$ComprometidoSEFI', '$DisponibleSEFI',
        '$ComprometidoSERBA', '$DisponibleSERBA', '$ComprometidoTRAN', '$DisponibleTRAN',
        '$ComprometidoGARE', '$DisponibleGARE', '$TPCSEGE', '$TPDSEGE', '$ComprometidoVentas',
        '$ObservacionesVentas', '$CostoVLF', '$CostoFLF', '$CostoVMG', '$CostoFMG', '$CostoVLFRI', '$CostoFLFRI'
    )";

    // Ejecutar la consulta
    mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/guardar.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
    <div class="contenedor">
        <?php
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Registro guardado correctamente</div>";
            } else {
                echo "<div class='mensaje error'>Error al guardar el registro. Error: " . mysqli_error($link) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='FormContabilidad.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>