<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cargas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/cargas.css">
	

</head>
<body>

	<header class="text-center my-4">
        <h1>BASE DE DATOS DE CARGAS</h1>
    </header>

	<main class="container">
		<section class="menu">
			<div class="menu-column">
				<a href= "registro.php" class="opc">
					<img src="../imagenes/registro.png" height="70" width="80" align="left" class="icono">
					<span>REGISTRO DE CARGAS</span>
				</a>

				<a href= "Consulta.php" class="opc">
					<img src="../imagenes/consulta.png" height="70" width="80" align="left" class="icono">
					<span>CONSULTA DE CARGAS</span>
				</a>

			</div>	

			<div class="menu-column">
            <a href= "Modificación.php" class="opc">
					<img src="../imagenes/modificacion.png" height="70" width="80" align="left" class="icono">
					<span>MODIFICACIÓN DE CARGAS</span>
				</a>
                
				<a href= "Bajas.php" class="opc">
					<img src="../imagenes/eliminar.png" height="70" width="80" align="left" class="icono">
					<span>ELIMINACIÓN DE CARGAS</span>
				</a>

			</div>
		</section>
		<br>
		<a href= "../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
	</main>
</body>
</html>