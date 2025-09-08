	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Menú</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/menuP.css">
	</head>
	<body>

		<header class="text-center my-4">
			<h1>MENÚ PRINCIPAL</h1>
			<div class="app-name">
				<span>SIGC</span>
			</div>
		</header>

		<main class="container">
			<section class="menu">
				<div class="menu-column">
					<a href= "../../php/index.php" class="opc">
						<img src="../imagenes/chofer.png" height="70" width="80" align="left" class="icono">
						<span>CHOFERES</span>
					</a>

					<a href="../../camiones/php/camP.php" class="opc">
						<img src="../imagenes/camion.png" height="70" width="80" align="left" class="icono">
						<span>CAMIONES</span>
					</a>

					<a href= "../../cargas/php/cargasP.php" class="opc">
						<img src="../imagenes/carga.png" height="70" width="80" align="left" class="icono">
						<span>CARGAS</span>
					</a>

					<a href= "../../empresa/php/empresaP.php" class="opc">
						<img src="../imagenes/empresa.png" height="70" width="80" align="left" class="icono">
						<span>EMPRESA</span>
					</a>
				</div>	

				<div class="menu-column">
					<a href= "../../horariosL/php/horarioP.php" class="opc">
						<img src="../imagenes/horario.png" height="70" width="80" align="left" class="icono">
						<span>HORARIOS LABORALES</span>
					</a>

					<a href= "../../mantenimiento/php/mantenimientoP.php" class="opc">
						<img src="../imagenes/mantenimiento.png" height="70" width="80" align="left" class="icono">
						<span>MANTENIMIENTO</span>
					</a>

					<a href= "../../rutas/php/rutasP.php" target="_blank" class="opc">
						<img src="../imagenes/ruta.png" height="70" width="80" align="left" class="icono">
						<span>RUTAS</span>
					</a>

					<a href= "../../reporte/php/reporteP.php" class="opc">
						<img src="../imagenes/reporte.png" height="70" width="80" align="left" class="icono">
						<span>REPORTE</span>
					</a>
				</div>
			</section>
			<br>
			<form action="logout.php" method="post">
				<button type="submit" class="btn btn-danger">Cerrar Sesión</button>
			</form>
		</main>
	</body>
	</html>