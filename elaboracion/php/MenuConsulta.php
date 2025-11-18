<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/elaboracionP.css">
	<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	

</head>
<body>

	<header class="text-center my-4">
        <h1>¿QUÉ DESEAS CONSULTAR?</h1>
    </header>

	<main class="container">
    <section class="menu">
        <div class="menu-column">
            <a href="ConPDC.php" class="opc">
                <img src="../imagenes/FPS.png" height="70" width="80" align="left" class="icono">
                <span>Producción, Despacho y Consumo</span>
            </a>
            <a href="ConMermas.php" class="opc">
                <img src="../imagenes/mermas.png" height="70" width="80" align="left" class="icono">
                <span>Mermas de Plolietileno</span>
            </a>
        </div>
        <div class="menu-column">
            <a href="ConEnvase.php" class="opc">
                <img src="../imagenes/envases.png" height="70" width="80" align="left" class="icono">
                <span>Envases Rotos</span>
            </a>
            <a href="ConSubG.php" class="opc">
                <img src="../imagenes/subgerencia.png" height="70" width="80" align="left" class="icono">
                <span>Subgerencia de Operaciones</span>
            </a>
        </div>
    </section>
    <br>
    <a href="../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
    <a href="elaboracionP.php" class="btn btn-danger">Regresar</a>
</main>
</body>
</html>