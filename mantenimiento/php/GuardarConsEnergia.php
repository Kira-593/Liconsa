<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    $CantidadDieselCTC = $_POST["CantidadDieselCTC"];
    $ReduccionITD = $_POST["ReduccionITD"];
    $PromedioRID = $_POST["PromedioRID"];
    $LitrosDLL = $_POST["LitrosDLL"];
    $ReduccionILD = $_POST["ReduccionILD"];
    $PromedioRILD = $_POST["PromedioRILD"];
    $CantidadEnergiaCTC = $_POST["CantidadEnergiaCTC"];
    $ReduccionITR = $_POST["ReduccionITR"];
    $PromedioRIT = $_POST["PromedioRIT"];
    $CantidadLLT = $_POST["CantidadLLT"];
    $ReduccionIKL = $_POST["ReduccionIKL"];
    $PromedioRIK = $_POST["PromedioRIK"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO m_consumo_energia_termica_electrica (
        Mes, CantidadDieselCTC, ReduccionITD, PromedioRID, LitrosDLL, ReduccionILD, PromedioRILD,
        CantidadEnergiaCTC, ReduccionITR, PromedioRIT, CantidadLLT, ReduccionIKL, PromedioRIK
    ) VALUES (
        '$Mes', '$CantidadDieselCTC', '$ReduccionITD', '$PromedioRID', '$LitrosDLL', '$ReduccionILD', '$PromedioRILD',
        '$CantidadEnergiaCTC', '$ReduccionITR', '$PromedioRIT', '$CantidadLLT', '$ReduccionIKL', '$PromedioRIK'
    )";

    // Ejecutar la consulta
    mysqli_query($link, $query);
?>

<html>
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
                echo "<div class='mensaje correcto'>Inserción correcta</div>";
            } else {
                echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_errno($link) . "</div>";
            }
            include "Cerrar.php";
        ?>
        <br><a href='FormConsEnergia.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='TipoFormulario.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>