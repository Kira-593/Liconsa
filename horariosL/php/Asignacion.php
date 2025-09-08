<?php
include "Conexion.php";

$query_camioneros = "SELECT CA_DNI, Nombre FROM camioneros";
$res_camioneros = mysqli_query($link, $query_camioneros);

$query_horarios = "SELECT ID_H, H_In, H_Fin FROM horario_lab";
$res_horarios = mysqli_query($link, $query_horarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Horarios a Camioneros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/asignacion.css">
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">

<div class="contenedor">
    <h1>Asignar Horarios a Camioneros</h1>
    <section class="asignacion">
        <h2>Seleccione el camionero y el horario que desea asignar:</h2>
    <form action="HacerAsignacion.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label for="camionero">Camionero:</label>
                <select name="camionero" id="camionero"  required>
                    <?php
                    while ($fila_camionero = mysqli_fetch_array($res_camioneros)) {
                        echo "<option value='" . $fila_camionero['CA_DNI'] . "'>" . $fila_camionero['CA_DNI'] . " - " . $fila_camionero['Nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="horario">Horario:</label>
                <select name="horario" id="horario" required>
                    <?php
                    while ($fila_horario = mysqli_fetch_array($res_horarios)) {
                        echo "<option value='" . $fila_horario['ID_H'] . "'>" . $fila_horario['ID_H'] . " - " . $fila_horario['H_In'] . " a " . $fila_horario['H_Fin'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <input type="submit" value="Asignar" class="btn btn-primary">
            </div>
        </div>
    </form>
    </section>
    <a href="horarioP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</div>
</main>
</body>
</html>