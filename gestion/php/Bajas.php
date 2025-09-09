<?php
	
	include "Conexion.php";
	
	$query="select * from ruta";
	$res= mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html>
	<head lang="es">
		<meta charset="UTF-8">
		<title>Eliminación</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bajas.css">
	</head>

	<body>
    <img src="../Imagenes/logo.png" class="logo">

<div class="contenedor">
    <h2>Eliminación de la Información de las Rutas</h2>
    <p class="info-text">Seleccione el ID de la Ruta que quiere eliminar.</p>

    <form method="get" action="Eliminar.php">
        <select name="sc" required>
            <?php
            while ($fila = mysqli_fetch_array($res)) {
                echo "<option value='" . $fila[0] . "'>" . $fila[0] ." - ".$fila[1]. "a" .$fila[2]. "</option>";
            }
            ?>
        </select>
        <input type="submit" name="elec" value="Eliminar">
    </form>

    <a href="rutasP.php" class="back-link">
        <img src="../Imagenes/home.png"  height="100" width="90">
    </a>
</div>

<?php include "Cerrar.php"; ?>

</body>
</html>