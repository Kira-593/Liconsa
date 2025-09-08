<?php
include "Conexion.php";

$query = "SELECT * FROM camioneros";
$res = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/modificacion.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<img src="../Imagenes/logo.png" class="logo">

    <div class="contenedor">
        <h1>MODIFICACIÓN DE LA INFORMACIÓN DE LOS CHOFERES</h1>
        <p>Seleccione el DNI del camionero que quiere modificar.</p>
        
        <form method="get" action="Actualizar.php">
            <label for="sc">DNI del Chofer:</label>
            <select name="sc" id="sc">
                <?php
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='" . $fila[0] . "'>" . $fila[0] . " - " . $fila['Nombre'] . "</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" name="elec" value="BUSCAR">
        </form>
        
        <a href="index.php"><img src="..\imagenes\home.png" alt="Inicio" height="100" width="90"></a>
    </div>
</body>
</html>

<?php
include "Cerrar.php";
?>