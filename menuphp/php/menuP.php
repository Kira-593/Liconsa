<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menú</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/menuP.css">
	<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">

</head>
<body>

	<header class="text-center my-4">
		<h1>MENÚ PRINCIPAL</h1>
		<div class="app-name">
			<span>Departamentos</span>
		</div>
	</header>

	<main class="container">
		<section class="menu">
			<div class="menu-column">
				<a href="../../Actividades del subcomite/php/ActP.php" class="opc">
					<img src="../imagenes/actividades del subcomite.png" height="70" width="80" align="left" class="icono">
					<span>ACTIVIDADES DEL SUBCOMITE</span>
				</a>
				<a href= "../../php/Padron.php" class="opc">
					<img src="../imagenes/padron de bene.png" height="70" width="80" align="left" class="icono">
					<span>PRADRÓN DE BENEFICIARIOS</span>
				</a>
				<a href="../../camiones/php/camP.php" class="opc">
					<img src="../imagenes/almacen.png" height="70" width="80" align="left" class="icono">
					<span>ALMACÉN</span>
				</a>
				<a href= "../../elaboracion/php/elaboracionP.php" class="opc">
					<img src="../imagenes/elaboracion.png" height="70" width="80" align="left" class="icono">
					<span>ELABORACIÓN</span>
				</a>
			</div>
			<div class="menu-column">
				<a href= "../../envasado/php/envasadoP.php" class="opc">
					<img src="../imagenes/envasado.png" height="70" width="80" align="left" class="icono">
					<span>ENVASADO</span>
				</a>
				<a href= "../../distribucion/php/distribucionP.php" class="opc">
					<img src="../imagenes/distribucion.png" height="70" width="80" align="left" class="icono">
					<span>DISTRIBUCIÓN</span>
				</a>
				<a href= "../../mantenimiento/php/mantenimientoP.php" class="opc">
					<img src="../imagenes/mantenimiento.png" height="70" width="80" align="left" class="icono">
					<span>MANTENIMIENTO</span>
				</a>
				<a href= "../../gestion/php/gestionP.php"  class="opc">
					<img src="../imagenes/gestion de trabajo.png" height="70" width="80" align="left" class="icono">
					<span>GESTIÓN DEL TRABAJO</span>
				</a>
			</div>
			<div class="menu-column">
				<a href= "../../reporte/php/reporteP.php" class="opc">
					<img src="../imagenes/control de calidad.png" height="70" width="80" align="left" class="icono">
					<span>CONTROL DE CALIDAD</span>
				</a>
				<a href= "../../reporte/php/reporteP.php" class="opc">
					<img src="../imagenes/adquisiciones.png" height="70" width="80" align="left" class="icono">
					<span>ADQUISICIONES</span>
				</a>
				<a href= "../../reporte/php/reporteP.php" class="opc">
					<img src="../imagenes/informatica.png" height="70" width="80" align="left" class="icono">
					<span>INFORMÁTICA</span>
				</a>
				<a href= "../../horariosL/php/horarioP.php" class="opc">
					<img src="../imagenes/recursos financieros.png" height="70" width="80" align="left" class="icono">
					<span>RECURSOS FINANCIEROS</span>
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