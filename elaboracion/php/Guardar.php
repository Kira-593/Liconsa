<?php
	include "Conexion.php";

	// Obtener los datos del formulario
	$ID = $_POST["ID"];
	$Nombre_C = $_POST["Nombre_C"];
	$Descripcion = $_POST["Descripcion"];
	$Peso = $_POST["Peso"];
	$ID_CA = $_POST["ID_CA"];

	// Consulta para insertar los datos en la base de datos
	$query = "INSERT INTO carga (ID_C, Nombre_C , Descripcion, Peso, ID_CA) 
			VALUES ('$ID', '$Nombre_C' , '$Descripcion', '$Peso', '$ID_CA')";

	// Ejecutar la consulta
	mysqli_query($link, $query);
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Guardar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/guardar.css">
</head>
<body>
	<img src="../Imagenes/logo.png" class="logo">
	<div class="contenedor">
		<?php
			if (mysqli_affected_rows($link) > 0) {
				echo "<div class='mensaje correcto'>Inserción correcta</div>";
			} else {
				if (mysqli_errno($link) == 1062) {
					echo "<div class='mensaje error'>DNI de Camionero duplicado, favor de revisar</div>";
				} else {
					echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_errno($link) . "</div>";
				}
			}
			include "Cerrar.php";
		?>
		<br><a href='registro.php' class='btn'>Realizar Otra Inserción</a><br>
		<br><a href='cargasP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>