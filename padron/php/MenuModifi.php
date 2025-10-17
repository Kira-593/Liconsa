<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tipo de Formulario</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/tipoformulario.css">
	<img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	

</head>
<body>

	<header class="text-center my-4">
        <h1>¿QUÉ DESEAS MODIFICAR?</h1>
    </header>

	<main class="container">
    <section class="menu">
    <div class="menu-columns">
        <!-- Columna izquierda -->
        <div class="menu-column">
            <a href="ModSubg.php" class="opc">
                <img src="../imagenes/padron.png" height="70" width="80" class="icono">
                <span>Subgerencia de Abasto</span>
            </a>
            <a href="ModDistribucion.php" class="opc">
                <img src="../imagenes/Distribucion.png" height="70" width="80" class="icono">
                <span>Distribución de Leche</span>
            </a>
        </div>

        <!-- Columna derecha -->
        <div class="menu-column">
            <a href="ModFactor.php" class="opc">
                <img src="../imagenes/FackTor.png" height="70" width="60" class="icono">
                <span>Factor de Retiro</span>
            </a>
            <a href="ModRutas.php" class="opc">
                <img src="../imagenes/rutas.png" height="70" width="80" class="icono">
                <span>Rutas de Distribución</span>
            </a>
        </div>
    </div>
</section>

    <br>
    <a href="../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
    <a href="PadronP.php" class="btn btn-danger">Regresar</a>
</main>
</body>
</html>