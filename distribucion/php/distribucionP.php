<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Camiones</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/distribucionP.css">
	<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

</head>
<body>

	<header class="text-center my-4">
        <h1>BASE DE DATOS DE HORARIOS</h1>
    </header>

	<main class="container">
		<section class="menu">
			<div class="menu-column">
				<a href= "registro.php" class="opc">
					<img src="../imagenes/registro.png" height="70" width="80" align="left" class="icono">
					<span>FORMULARIO</span>
				</a>

				<a href= "Modificación.php" class="opc">
					<img src="../imagenes/modificacion.png" height="70" width="80" align="left" class="icono">
					<span>MODIFICACIÓN DE FORMULARIOS</span>
				</a>

			</div>	
			<div class="menu-column">
				<a href= "Consulta.php" class="opc">
					<img src="../imagenes/consulta.png" height="70" width="80" align="left" class="icono">
					<span>CONSULTA DE FORMULARIOS</span>
				</a>
				
				<a href= "Bajas.php" class="opc">
					<img src="../imagenes/eliminar.png" height="70" width="80" align="left" class="icono">
					<span>ELIMINACIÓN DE FORMULARIOS</span>
				</a>
		</section>
		<br>
		<a href= "../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>