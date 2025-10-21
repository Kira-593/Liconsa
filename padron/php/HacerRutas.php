<?php
include "Conexion.php";

// Obtener datos del formulario
$ID = $_POST['id'] ?? '';
$Mes = $_POST['Mes'] ?? '';
$LitrosTRuno = $_POST['LitrosTRuno'] ?? '';
$PorcentajeTRuno = $_POST['PorcentajeTRuno'] ?? '';
$LitrosTRdos = $_POST['LitrosTRdos'] ?? '';
$PorcentajeTRdos = $_POST['PorcentajeTRdos'] ?? '';
$LitrosTRtres = $_POST['LitrosTRtres'] ?? '';
$PorcentajeTRtres = $_POST['PorcentajeTRtres'] ?? '';
$LitrosTRcuatro = $_POST['LitrosTRcuatro'] ?? '';
$PorcentajeTRcuatro = $_POST['PorcentajeTRcuatro'] ?? '';

// Sanitizar (mitigación básica)
$ID_e = mysqli_real_escape_string($link, $ID);
$Mes_e = mysqli_real_escape_string($link, $Mes);
$LitrosTRuno_e = mysqli_real_escape_string($link, $LitrosTRuno);
$PorcentajeTRuno_e = mysqli_real_escape_string($link, $PorcentajeTRuno);
$LitrosTRdos_e = mysqli_real_escape_string($link, $LitrosTRdos);
$PorcentajeTRdos_e = mysqli_real_escape_string($link, $PorcentajeTRdos);
$LitrosTRtres_e = mysqli_real_escape_string($link, $LitrosTRtres);
$PorcentajeTRtres_e = mysqli_real_escape_string($link, $PorcentajeTRtres);
$LitrosTRcuatro_e = mysqli_real_escape_string($link, $LitrosTRcuatro);
$PorcentajeTRcuatro_e = mysqli_real_escape_string($link, $PorcentajeTRcuatro);

// Construir la consulta UPDATE
$query = "UPDATE p_rutasdistribucion SET
    Mes='$Mes_e',
    LitrosTRuno='$LitrosTRuno_e',
    PorcentajeTRuno='$PorcentajeTRuno_e',
    LitrosTRdos='$LitrosTRdos_e',
    PorcentajeTRdos='$PorcentajeTRdos_e',
    LitrosTRtres='$LitrosTRtres_e',
    PorcentajeTRtres='$PorcentajeTRtres_e',
    LitrosTRcuatro='$LitrosTRcuatro_e',
    PorcentajeTRcuatro='$PorcentajeTRcuatro_e'
 WHERE id='$ID_e'";

mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Rutas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/hacer.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
    <div class="contenedor">
        <?php
            if (mysqli_affected_rows($link) > 0) {
                echo "<div class='mensaje correcto'>Actualización correcta</div>";
            } else {
                if (mysqli_error($link)) {
                    echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_error($link) . "</div>";
                } else {
                    echo "<div class='mensaje advertencia'>Actualización ejecutada. No se detectaron cambios en el registro.</div>";
                }
            }
            include "Cerrar.php";
        ?>
        <br><a href='ModRutas.php' class='btn'>Regresar a Actualizar Otro Registro</a><br>
        <br><a href='MenuModifi.php'><img src='../imagenes/home.png' height='100' width='90' alt='Volver al menú de modificación'></a>
    </div>
</body>
</html>
