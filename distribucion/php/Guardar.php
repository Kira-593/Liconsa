<?php
	include "Conexion.php";

	// Obtener los datos del formulario
	$ID = $_POST["ID"];
	$H_I = $_POST["H_I"];
	$H_F = $_POST["H_F"];
	$D_L = $_POST["D_L"];

	// Consulta para insertar los datos en la base de datos
	$query = "INSERT INTO horario_lab (ID_H, H_In, H_Fin, Dias_Lab) 
			VALUES ('$ID', '$H_I', '$H_F', '$D_L')";

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
					echo "<div class='mensaje error'>DNI del Horario duplicado, favor de revisar</div>";
				} else {
					echo "<div class='mensaje error'>Inserción incorrecta. Error: " . mysqli_errno($link) . "</div>";
				}
			}
			include "Cerrar.php";
		?>
		<br><a href='registro.php' class='btn'>Realizar Otra Inserción</a><br>
		<br><a href='horarioP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>