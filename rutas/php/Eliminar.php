<?php
	include "Conexion.php";
	
	$ID = $_GET["sc"];
	$query = "DELETE FROM ruta WHERE ID_RU='$ID'";
	mysqli_query($link, $query);
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Eliminación</title>
	<link rel="stylesheet" href="../css/eliminar.css">
</head>
<body>
<img src="../Imagenes/logo.png" class="logo">

	<div class="contenedor">
		<?php
			if (mysqli_affected_rows($link) > 0) {
				echo "<div class='mensaje correcto'>Eliminación correcta</div>";
			} else {
				echo "<div class='mesaje error'>Eliminación incorrecta. Error: " . mysqli_errno($link) . "</div>";
			}
			include "Cerrar.php";
		?>
		<hr>
		<a href='Bajas.php' class='btn'>REGRESAR A REALIZAR OTRA ELIMINACIÓN</a>
		<br><br>
		<a href='rutasP.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>