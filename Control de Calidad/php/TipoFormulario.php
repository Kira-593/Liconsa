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
        <h1>¿QUÉ DESEAS HACER?</h1>
    </header>

	<main class="container">
    <section class="menu">
    <div class="menu-columns">
        <!-- Columna izquierda -->
        <div class="menu-column">
            <a href="FormFM.php" class="opc">
                <img src="../imagenes/micro.png" height="70" width="80" class="icono">
                <span>Análisis Realizados</span>
            </a>
            <a href="FormRCT.php" class="opc">
                <img src="../imagenes/capytrans.png" height="70" width="80" class="icono">
                <span>Captación y Transferencia</span>
            </a>
        </div>

        <!-- Columna derecha -->
        <div class="menu-column">
            <a href="FormGPS.php" class="opc">
                <img src="../imagenes/determinacion.png" height="70" width="80" class="icono">
                <span>Determinación</span>
            </a>
            <a href="FormEvaluacion.php" class="opc">
                <img src="../imagenes/desempenio.png" height="70" width="80" class="icono">
                <span>Evaluación del Desempeño</span>
            </a>
        </div>
    </div>      
    
    <!-- Botón centrado abajo -->
    <div class="menu-bottom">
        <a href="FormContenidoNyP.php" class="opc">
            <img src="../imagenes/botella.png" height="70" width="80" class="icono">
            <span>Contenido Neto y Peso de Envase vacío.</span>
        </a>
        
    </div>
</section>

    <br>
    <a href="../../menuphp/php/menuP.php" class="btn btn-danger">Menú principal</a>
    <a href="ControlP.php" class="btn btn-danger">Regresar</a>
</main>
</body>
</html>