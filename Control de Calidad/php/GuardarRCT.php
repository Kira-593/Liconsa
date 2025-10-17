<?php
    include "Conexion.php";

    // Obtener los datos del formulario
    $Proveedor = $_POST["Provedor"];
    $Folio = $_POST["Folio"];
    $FechaDictamen = $_POST["FechaDictamen"];
    $Remision = $_POST["Remision"];
    $Densidad = $_POST["Densidad"];
    $Volumen = $_POST["Volumen"];
    $Grasa = $_POST["Grasa"];
    $SNG = $_POST["SNG"];
    $Proteina = $_POST["Proteina"];
    $Caseina = $_POST["Caseina"];
    $Acidez = $_POST["Acidez"];
    $Temperatura = $_POST["Temperatura"];
    $PH = $_POST["PH"];
    $Reductasa = $_POST["Reductasa"];

    // Consulta para insertar los datos en la base de datos
    $query = "INSERT INTO c_captacionleche (
        Proveedor, Folio, FechaDictamen, Remision, Densidad, Volumen, 
        Grasa, SNG, Proteina, Caseina, Acidez, Temperatura, PH, Reductasa
    ) VALUES (
        '$Proveedor', $Folio, '$FechaDictamen', '$Remision', $Densidad, $Volumen,
        $Grasa, $SNG, $Proteina, $Caseina, $Acidez, $Temperatura, $PH, $Reductasa
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
        <br><a href='FormRCT.php' class='btn'>Realizar Otro Registro</a><br>
        <br><a href='TipoFormulario.php' class='home-link'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>