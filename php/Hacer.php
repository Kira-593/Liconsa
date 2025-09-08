<?php
include "Conexion.php";

// Obtener los datos del formulario
$DNI1 = $_POST["DNI"];
$Nombre1 = $_POST["Nombre"];
$ap1 = $_POST["ap"];
$am1 = $_POST["am"];
$nt1 = $_POST["nt"];
$CodigoP1 = $_POST["CodigoP"];
$Estado1 = $_POST["Estado"];
$Población1 = $_POST["Población"];
$Colonia1 = $_POST["Colonia"];
$Calle1 = $_POST["Calle"];
$nc1 = $_POST["nc"];
$Salario1 = $_POST["Salario"];
$Empresa1 = $_POST["Empresa"];

// Verifica que los nombres de los campos coincidan con los nombres en la tabla 'camioneros'
$query = "UPDATE camioneros SET
			Nombre='$Nombre1', Apellido_p='$ap1', Apellido_m='$am1', N_teléfono='$nt1', Codigo_Postal='$CodigoP1', Estado_vive='$Estado1', Población='$Población1',
			Colonia='$Colonia1', Calle='$Calle1', N_casa='$nc1', Salario='$Salario1', ID_EM='$Empresa1' WHERE CA_DNI='$DNI1'";

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
	    <a href="Modificación.php" class="btn">Regresar a Actualizar Otro Chofer</a><br>
		<br><a href='index.php'><img src='..\imagenes\home.png' height='100' width='90'></a>
	</div>
</body>
</html>