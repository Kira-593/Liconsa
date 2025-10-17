<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    $ServiciosSTS = $_POST["ServiciosSTS"];
    $ServiciosATS = $_POST["ServiciosATS"];
    $PorcentajeCTP = $_POST["PorcentajeCTP"];
    $MetaTM = $_POST["MetaTM"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO c_evaluaciondesempeno (
        Mes, ServiciosSTS, ServiciosATS, PorcentajeCTP, MetaTM
    ) VALUES (
        '$Mes', '$ServiciosSTS', '$ServiciosATS', '$PorcentajeCTP', $MetaTM
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
        <br><a href='FormEvaluacion.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>