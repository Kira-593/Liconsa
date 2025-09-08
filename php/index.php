<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menú</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/index.css">
	

</head>
<body>

	<header class="text-center my-4">
        <h1>BASE DE DATOS DE CHOFERES</h1>
    </header>

	<main class="container">
		<section class="menu">
			<div class="menu-column">
				<a href= "Camionero.php" class="opc">
					<img src="../imagenes/registro.png" height="70" width="80" align="left" class="icono">
					<span>REGISTRO DE CHOFERES</span>
				</a>

				<a href= "Consulta.php" class="opc">
					<img src="../imagenes/consulta.png" height="70" width="80" align="left" class="icono">
					<span>CONSULTA DE CHOFERES</span>
				</a>

				<a href= "Modificación.php" class="opc">
					<img src="../imagenes/modificacion.png" height="70" width="80" align="left" class="icono">
					<span>MODIFICACIÓN DE CHOFERES</span>
				</a>
			</div>	

			<div class="menu-column">
				<a href= "Bajas.php" class="opc">
					<img src="../imagenes/eliminar.png" height="70" width="80" align="left" class="icono">
					<span>ELIMINACIÓN DE CHOFERES</span>
				</a>

				<a href= "Reporte.php" class="opc">
					<img src="../imagenes/reporte.png" height="70" width="80" align="left" class="icono">
					<span>ELABORACIÓN DE REPORTE</span>
				</a>

				<a href= "Impresión.php" target="_blank" class="opc">
					<img src="../imagenes/impresion.png" height="70" width="80" align="left" class="icono">
					<span>IMPRESIÓN DE DATOS</span>
				</a>
			</div>
		</section>
		<br>
		<a href= "../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>