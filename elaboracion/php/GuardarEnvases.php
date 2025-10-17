<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Indicador = $_POST["Indicador"];
    $Mes = $_POST["Mes"];
    $DF = $_POST["DF"];
    $MC = $_POST["MC"];
    $MI = $_POST["MI"];
    $Total = $_POST["Total"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO e_envases_rotos (
        Indicador, Mes, DF, MC, MI, Total
    ) VALUES (
        '$Indicador', '$Mes', '$DF', '$MC', '$MI', '$Total'
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
        <br><a href='FormEnvase.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='TipoFormulario.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>