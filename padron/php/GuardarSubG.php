<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    $MetaETM = $_POST["MetaETM"];
    $CantidadDTC = $_POST["CantidadDTC"];
    $CantidadFTC = $_POST["CantidadFTC"];
    $TBuno = $_POST["TBuno"];
    $Porcentajebuno = $_POST["Porcentajebuno"];
    $TBdos = $_POST["TBdos"];
    $Porcentajetbdos = $_POST["Porcentajetbdos"];
    $TBtres = $_POST["TBtres"];
    $Porcentajetbtres = $_POST["Porcentajetbtres"];
    $TBCuatro = $_POST["TBCuatro"];
    $Porcentajetbcuatro = $_POST["Porcentajetbcuatro"];
    $TBCinco = $_POST["TBCinco"];
    $Porcentajetbcinco = $_POST["Porcentajetbcinco"];
    $TBseis = $_POST["TBseis"];
    $Porcentajetbseis = $_POST["Porcentajetbseis"];
    $TBsiete = $_POST["TBsiete"];
    $Porcentajetbsiete = $_POST["Porcentajetbsiete"];
    $BajasTB = $_POST["BajasTB"];
    $AltasTA = $_POST["AltasTA"];
    $VariacionTV = $_POST["VariacionTV"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO p_subgerenciaabasto (
        Mes, MetaETM, CantidadDTC, CantidadFTC, TBuno, Porcentajebuno, TBdos, Porcentajetbdos, TBtres, Porcentajetbtres, 
        TBCuatro, Porcentajetbcuatro, TBCinco, Porcentajetbcinco, TBseis, Porcentajetbseis, TBsiete, Porcentajetbsiete, 
        BajasTB, AltasTA, VariacionTV
    ) VALUES (
        '$Mes', '$MetaETM', '$CantidadDTC', '$CantidadFTC', '$TBuno', '$Porcentajebuno', '$TBdos', '$Porcentajetbdos', '$TBtres', '$Porcentajetbtres',
        '$TBCuatro', '$Porcentajetbcuatro', '$TBCinco', '$Porcentajetbcinco', '$TBseis', '$Porcentajetbseis', '$TBsiete', '$Porcentajetbsiete',
        '$BajasTB', '$AltasTA', '$VariacionTV'
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
        <br><a href='FormSubg.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='TipoFormulario.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
    </div>
</body>
</html>