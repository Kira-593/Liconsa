<?php
include "Conexion.php";

// Consulta para obtener los mantenimientos junto con la marca del camión
$query = "SELECT m.ID_MAN, c.Marca 
          FROM mantenimiento m
          JOIN camiones c ON m.ID_CA = c.ID_CA";
$res = mysqli_query($link, $query);

// Verificar si la consulta devolvió resultados
if (!$res) {
    die("Error en la consulta: " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/consulta.css">
</head>

<body>
    <img src="../Imagenes/logo.png" class="logo">

    <div class="contenedor">
        <h1>Consulta de Información de los Mantenimientos</h1>
        <p>Seleccione el ID del mantenimiento.</p>

        <form method="get" action="ver.php">
            <select name="sc" required>
                <?php
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='" . $fila['ID_MAN'] . "'>" . $fila['ID_MAN'] . " - " . $fila['Marca'] . "</option>";
                }
                include "Cerrar.php";
                ?>
            </select>
            <input type="submit" name="elec" value="Buscar">
        </form>

        <a href="mantenimientoP.php" class="link">
            <img src="../imagenes/home.png" height="100" width="90" alt="Inicio">
        </a>
    </div>
</body>
</html>