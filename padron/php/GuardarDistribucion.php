<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Indicador = $_POST["Indicador"];
    $Mes = $_POST["Mes"];
    $MetaTM = $_POST["MetaTM"];
    $AlcanceTA = $_POST["AlcanceTA"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO p_distribucionleche (
        Indicador, Mes, MetaTM, AlcanceTA
    ) VALUES (
        '$Indicador', '$Mes', '$MetaTM', '$AlcanceTA'
    )";

    // Ejecutar la consulta
    mysqli_query($link, $query);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Guardar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <br><a href='FormDistribucion.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='TipoFormulario.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>