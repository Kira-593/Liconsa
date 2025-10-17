<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    $LitrosFres = $_POST["LitrosFres"];
    $SHp = $_POST["SHp"];
    $SNGp = $_POST["SNGp"];
    $volumenTA = $_POST["volumenTA"];
    $solidosTA = $_POST["solidosTA"];
    $VolumenTC = $_POST["VolumenTC"];
    $TotalTC = $_POST["%TotalTC"];
    $VolumenTP = $_POST["VolumenTP"];
    $LecheTP = $_POST["LecheTP"];
    $PorsentajeTP = $_POST["PorsentajeTP"];
    $ProduccionTP = $_POST["ProduccionTP"];
    $ContenidoTC = $_POST["ContenidoTC"];
    $DiasOTD = $_POST["DiasOTD"];
    $CapacidadITC = $_POST["CapacidadITC"];
    $TotalCapacidad = $_POST["TotalCapacidad"];
    $ProduccionATP = $_POST["ProduccionATP"];
    $ProduccionFTP = $_POST["ProduccionFTP"];
    $TotalProduccion = $_POST["TotalProduccion"];
    $DiasATD = $_POST["DiasATD"];
    $HidroxidoTH = $_POST["HidroxidoTH"];
    $TotalATT_Hidroxido = $_POST["TotalATT"];
    $AcumuladoCTA_Hidroxido = $_POST["AcumuladoCTA"];
    $AcidoFTA = $_POST["AcidoFTA"];
    $TotalATT_Acido = $_POST["TotalATT"];
    $AcumuladoCTA_Acido = $_POST["AcumuladoCTA"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO e_subgerencia_operaciones (
        Mes, LitrosFres, SHp, SNGp, volumenTA, solidosTA, VolumenTC, TotalTC, VolumenTP, LecheTP, PorsentajeTP, ProduccionTP, ContenidoTC,
        DiasOTD, CapacidadITC, TotalCapacidad, ProduccionATP, ProduccionFTP, TotalProduccion,
        DiasATD, HidroxidoTH, TotalATT_Hidroxido, AcumuladoCTA_Hidroxido, AcidoFTA, TotalATT_Acido, AcumuladoCTA_Acido
    ) VALUES (
        '$Mes', '$LitrosFres', '$SHp', '$SNGp', '$volumenTA', '$solidosTA', '$VolumenTC', '$TotalTC', '$VolumenTP', '$LecheTP', '$PorsentajeTP', '$ProduccionTP', '$ContenidoTC',
        '$DiasOTD', '$CapacidadITC', '$TotalCapacidad', '$ProduccionATP', '$ProduccionFTP', '$TotalProduccion',
        '$DiasATD', '$HidroxidoTH', '$TotalATT_Hidroxido', '$AcumuladoCTA_Hidroxido', '$AcidoFTA', '$TotalATT_Acido', '$AcumuladoCTA_Acido'
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
        <br><a href='FormSubG.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='TipoFormulario.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>