<?php
include "Conexion.php";

// Consulta para obtener los horarios asignados
$query_horarios_asignados = "SELECT hc.id_horario, h.H_In, h.H_Fin, c.CA_DNI, c.Nombre 
                             FROM horarios_camioneros hc
                             JOIN horario_lab h ON hc.id_horario = h.ID_H
                             JOIN camioneros c ON hc.id_camionero = c.CA_DNI";
$res_horarios_asignados = mysqli_query($link, $query_horarios_asignados);

// Verificar si la consulta devolvió resultados
if (!$res_horarios_asignados) {
    die("Error en la consulta: " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Asignación de Horarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ModifiAsig.css">
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<main class="container">
<div class="contenedor">
    <h1>Modificar Asignación de Horarios</h1>
    <form action="HacerModificacion.php" method="GET">
        <div class="row">
            <div class="col-md-12">
                <label for="horario_asignado">Seleccione el horario asignado que desea modificar:</label>
                <select name="horario_asignado" id="horario_asignado" required>
                    <?php
                    while ($fila = mysqli_fetch_array($res_horarios_asignados)) {
                        echo "<option value='" . $fila['id_horario'] . "|" . $fila['CA_DNI'] . "'>" . $fila['id_horario'] . " - " . $fila['H_In'] . " a " . $fila['H_Fin'] . " - " . $fila['CA_DNI'] . " - " . $fila['Nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <input type="submit" value="Modificar" class="btn btn-primary">
            </div>
        </div>
    </form>
    <a href="horarioP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</div>
</main>
</body>
</html>