<?php
include "Conexion.php";

// Obtener los datos del formulario
$ID = $_POST["ID"];
$Nombre_C = $_POST["Nombre_C"];
$Descripcion = $_POST["Descripcion"];
$Peso = $_POST["Peso"];
$ID_CA = $_POST["ID_CA"];

// Consulta para actualizar los datos en la base de datos
$query = "UPDATE carga SET
			Nombre_C='$Nombre_C', Descripcion='$Descripcion', Peso='$Peso', ID_CA='$ID_CA'
		  WHERE ID_C='$ID'";

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
	    <a href="Modificación.php" class="btn">Regresar a Actualizar Otra Carga</a><br>
		<br><a href='cargasP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>