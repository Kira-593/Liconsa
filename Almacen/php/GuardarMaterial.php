<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Indicador = $_POST["Indicador"];
    $Mes = $_POST["Mes"];
    $CodigoTC = $_POST["CodigoTC"];
    $DescripcionTD = $_POST["DescripcionTD"];
    $CantidadITC = $_POST["CantidadITC"];
    $CantidadETC = $_POST["CantidadETC"];
    $CantidadCTC = $_POST["CantidadCTC"];
    $CantidadFTC = $_POST["CantidadFTC"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO a_existenciasmaterial (
        Indicador, Mes, CodigoTC, DescripcionTD, CantidadITC, CantidadETC, CantidadCTC, CantidadFTC
    ) VALUES (
        '$Indicador', '$Mes', '$CodigoTC', '$DescripcionTD', '$CantidadITC', '$CantidadETC', '$CantidadCTC', '$CantidadFTC'
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
        <br><a href='FormMaterial.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='php/TipoFormulario.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>