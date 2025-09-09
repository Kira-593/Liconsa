<?php
	
	include "Conexion.php";
	
	$query="select * from ruta";
	$res= mysqli_query($link, $query);

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
    <h1>Consulta de Información de las rutas</h1>
    <p>Seleccione el ID de la ruta.</p>

    <form method="get" action="ver.php">
        <select name="sc" required>
            <?php
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='" . $fila[0] . "'>" . $fila[0] ." - ".$fila['RU_IN']. " a ".$fila['RU_FIN']."</option>";
                }
                include "Cerrar.php";
            ?>
        </select>
        <input type="submit" name="elec" value="Buscar">
    </form>

    <a href="rutasP.php" class="link">
        <img src="../imagenes/home.png" height="100" width="90" alt="Inicio">
    </a>
</div>

</body>
</html>