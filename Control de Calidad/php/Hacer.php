<?php
include "Conexion.php";

// Obtener los datos del formulario
$ID = $_POST["ID"];
$Descripcion = $_POST["Descripcion"];
$Fecha_I = $_POST["Fecha_I"];
$Fecha_F = $_POST["Fecha_F"];
$Camion = $_POST["Camion"];

// Consulta para actualizar los datos en la base de datos
$query = "UPDATE mantenimiento SET
			Descripcion='$Descripcion', Fecha_I='$Fecha_I', Fecha_S='$Fecha_F', ID_CA='$Camion'
		  WHERE ID_MAN='$ID'";

// Ejecutar la consulta
mysqli_query($link, $query);
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Modificado</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/hacer.css">
</head>
<body>
	<div class="contenedor">
		<?php
			if (mysqli_affected_rows($link) > 0) {
				echo "<div class='mensaje correcto'>Actualización correcta</div>";
			} else {
				echo "<div class='mensaje error'>Actualización incorrecta. Error: " . mysqli_errno($link) . "</div>";
			}
			include "Cerrar.php";
		?>
	    <a href="Modificación.php" class="btn">Regresar a Actualizar Otro Mantenimiento</a><br>
		<br><a href='mantenimientoP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>