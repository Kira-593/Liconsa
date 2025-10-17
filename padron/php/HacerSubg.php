<?php
// Incluye la conexión a la base de datos
include "Conexion.php";

// 1. Obtener los 21 datos del formulario
// Nota: El campo 'Mes' actúa como identificador (clave de actualización).
$id= $_POST["id"];
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

// 2. Consulta para actualizar los datos en la tabla 'p_subgerenciaabasto'
$query = "UPDATE p_subgerenciaabasto SET
			Mes='$Mes',
            MetaETM='$MetaETM', 
            CantidadDTC='$CantidadDTC', 
            CantidadFTC='$CantidadFTC', 
            TBuno='$TBuno', 
            Porcentajebuno='$Porcentajebuno', 
            TBdos='$TBdos', 
            Porcentajetbdos='$Porcentajetbdos', 
            TBtres='$TBtres', 
            Porcentajetbtres='$Porcentajetbtres', 
            TBCuatro='$TBCuatro', 
            Porcentajetbcuatro='$Porcentajetbcuatro', 
            TBCinco='$TBCinco', 
            Porcentajetbcinco='$Porcentajetbcinco', 
            TBseis='$TBseis', 
            Porcentajetbseis='$Porcentajetbseis', 
            TBsiete='$TBsiete', 
            Porcentajetbsiete='$Porcentajetbsiete', 
            BajasTB='$BajasTB', 
            AltasTA='$AltasTA', 
            VariacionTV='$VariacionTV'
          WHERE id='$id'"; // Se usa 'Mes' como identificador único

// 3. Ejecutar la consulta
mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Indicador Modificado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Se mantiene la referencia al CSS original -->
    <link rel="stylesheet" href="../css/hacer.css"> 
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            // 4. Mostrar el resultado de la operación
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Actualización de Indicadores correcta</div>";
            } else {
                // Se verifica si hubo un error o si el registro no cambió
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización finalizada. No se detectaron cambios en el registro o el Mes es incorrecto.</div>";
                }
            }
            include "Cerrar.php"; // Cierra la conexión a la DB
        ?>
        <!-- Se actualizan los enlaces de regreso para reflejar el contexto de indicadores -->
         <a href="ModDistribucion.php" class="btn">Regresar a Actualizar Otro Formulario</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90'></a>
    </div>
</body>
</html>