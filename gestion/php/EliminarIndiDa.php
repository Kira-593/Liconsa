<?php
	include "Conexion.php";
	
	$ID = $_GET["sc"];
	$query = "DELETE FROM g_indicador_da WHERE Id='$ID'";
	mysqli_query($link, $query);
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Eliminación</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
	<link rel="stylesheet" href="../css/eliminar.css">	
</head>
<body>

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
		<a href='BajasIndiDa.php' class='btn'>REGRESAR A REALIZAR OTRA ELIMINACIÓN</a>
		<br><br>
		<a href='MenuIndiDa.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>