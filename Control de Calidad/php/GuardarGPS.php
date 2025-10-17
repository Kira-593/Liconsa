<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Indicador = $_POST["Indicador"];
    $Mes = $_POST["Mes"];
    $Metodo = $_POST["Metodo"];
    $Muestra = $_POST["Muestra"];
    $ValorR = $_POST["ValorR"];
    $ValorMax = $_POST["ValorMax"];
    $ValorMin = $_POST["ValorMin"];
    $UnidadesKG = $_POST["UnidadesKG"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO  c_formulariogps (
        Indicador, Mes, Metodo, Muestra, ValorR, ValorMax, ValorMin, UnidadesKG
    ) VALUES (
        '$Indicador', '$Mes', '$Metodo', '$Muestra', $ValorR, $ValorMax, $ValorMin, $UnidadesKG
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
        <br><a href='FormGPS.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>