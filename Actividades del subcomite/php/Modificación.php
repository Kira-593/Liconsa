<?php
include "Conexion.php";

$query = "SELECT * FROM camiones";
$res = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/modificacion.css">
</head>

<body>
<img src="../Imagenes/logo.png" class="logo">

    <div class="contenedor">
        <h1>MODIFICACIÓN DE LA INFORMACIÓN DE LOS CAMIONES</h1>
        <p>Seleccione el ID del camión que quiere modificar.</p>
        
        <form method="get" action="actualizar.php">
            <label for="sc">ID del Camion:</label>
            <select name="sc" id="sc" required>
                <?php
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila['Marca'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" name="elec" value="BUSCAR">
        </form>
        
        <a href="camP.php"><img src="..\imagenes\home.png" alt="Inicio" height="100" width="90"></a>
    </div>
</body>
</html>

<?php
include "Cerrar.php";
?>
