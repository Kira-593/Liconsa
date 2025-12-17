<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Mes = $_POST["Mes"];
    $NumeroTrabajadores = $_POST["NumeroTrabajadores"];
    $TrabajadoresH = $_POST["TrabajadoresH"];
    $HombresConfianza = $_POST["HombresConfianza"];
    $HombresSindicato = $_POST["HombresSindicato"];
    $TrabajadoresM = $_POST["TrabajadoresM"];
    $MujeresConfianza = $_POST["MujeresConfianza"];
    $MujeresSindicato = $_POST["MujeresSindicato"];
    $TrabajadoresConfianza = $_POST["TrabajadoresConfianza"];
    $TrabajadoresSindicato = $_POST["TrabajadoresSindicato"];
    $NumeroPlazasOcupadas = $_POST["NumeroPlazasOcupadas"];
    $VacantesTV = $_POST["VacantesTV"];
    $IncapacidadesTI = $_POST["IncapacidadesTI"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO g_relacionesindustriales (
        Mes, NumeroTrabajadores, TrabajadoresH, HombresConfianza, HombresSindicato, TrabajadoresM, MujeresConfianza, MujeresSindicato,
        TrabajadoresConfianza, TrabajadoresSindicato, NumeroPlazasOcupadas, VacantesTV, IncapacidadesTI
    ) VALUES (
        '$Mes', '$NumeroTrabajadores', '$TrabajadoresH', '$HombresConfianza', '$HombresSindicato', '$TrabajadoresM', '$MujeresConfianza', '$MujeresSindicato',
        '$TrabajadoresConfianza', '$TrabajadoresSindicato', '$NumeroPlazasOcupadas', '$VacantesTV', '$IncapacidadesTI'
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
        <br><a href='FormRelaciones.php' class='btn'>Realizar Otra Inserción</a><br>
        <br><a href='gestionP.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>