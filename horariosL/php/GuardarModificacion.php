<?php
include "Conexion.php";

$id_horario = $_POST['id_horario'];
$dni_camionero_actual = $_POST['dni_camionero'];
$nuevo_camionero = $_POST['nuevo_camionero'];

// Verificar si la combinación ya existe
$query_verificar = "SELECT * FROM horarios_camioneros WHERE id_horario = '$id_horario' AND id_camionero = '$nuevo_camionero'";
$res_verificar = mysqli_query($link, $query_verificar);

if (mysqli_num_rows($res_verificar) > 0) {
    echo "<script>
            alert('Error: La asignación ya existe.');
            window.location.href='HacerModificacion.php?horario_asignado=$id_horario|$dni_camionero_actual';
          </script>";
    exit;
}

// Actualizar la asignación
$query_actualizar = "UPDATE horarios_camioneros SET id_camionero = '$nuevo_camionero' WHERE id_horario = '$id_horario' AND id_camionero = '$dni_camionero_actual'";
if (mysqli_query($link, $query_actualizar)) {
    echo "<script>
            alert('Asignación modificada correctamente.');
            window.location.href='ModifiAsig.php';
          </script>";
} else {
    echo "<script>
            alert('Error al modificar la asignación: " . mysqli_error($link) . "');
            window.location.href='HacerModificacion.php?horario_asignado=$id_horario|$dni_camionero_actual';
          </script>";
}

mysqli_close($link);
?>