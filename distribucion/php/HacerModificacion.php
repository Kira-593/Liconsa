<?php
include "Conexion.php";

if (isset($_GET['horario_asignado'])) {
    list($id_horario, $dni_camionero) = explode('|', $_GET['horario_asignado']);

    // Consulta para obtener los detalles del horario asignado
    $query_detalle = "SELECT hc.id_horario, h.H_In, h.H_Fin, c.CA_DNI, c.Nombre 
                      FROM horarios_camioneros hc
                      JOIN horario_lab h ON hc.id_horario = h.ID_H
                      JOIN camioneros c ON hc.id_camionero = c.CA_DNI
                      WHERE hc.id_horario = '$id_horario' AND hc.id_camionero = '$dni_camionero'";
    $res_detalle = mysqli_query($link, $query_detalle);
    $detalle = mysqli_fetch_array($res_detalle);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Asignación de Horarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/hacermodificacion.css">
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">
<div class="contenedor">
    <h1>Modificar Asignación de Horarios</h1>
    <form action="GuardarModificacion.php" method="POST">
        <input type="hidden" name="id_horario" value="<?= $detalle['id_horario'] ?>">
        <input type="hidden" name="dni_camionero" value="<?= $detalle['CA_DNI'] ?>">
        <div class="row">
            <div class="col-md-6">
                <label for="camionero">Camionero:</label>
                <input type="text" name="camionero" id="camionero" value="<?= $detalle['CA_DNI'] . " - " . $detalle['Nombre'] ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="horario">Horario:</label>
                <input type="text" name="horario" id="horario" value="<?= $detalle['H_In'] . " a " . $detalle['H_Fin'] ?>" readonly>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="nuevo_camionero">Nuevo Camionero:</label>
                <select name="nuevo_camionero" id="nuevo_camionero" required>
                    <?php
                    $query_camioneros = "SELECT CA_DNI, Nombre FROM camioneros";
                    $res_camioneros = mysqli_query($link, $query_camioneros);
                    while ($fila_camionero = mysqli_fetch_array($res_camioneros)) {
                        echo "<option value='" . $fila_camionero['CA_DNI'] . "'>" . $fila_camionero['CA_DNI'] . " - " . $fila_camionero['Nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <input type="submit" value="Guardar Cambios" class="btn btn-primary">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='ModifiAsig.php'">Cancelar</button>
            </div>
        </div>
    </form>
    <a href="horarioP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</div>
</body>
</html>