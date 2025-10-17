<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formFM.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Formulario de FM</h1>
    
    <section class="Registro">
        <form method="post" action="GuardarFM.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Indicador">Indicador</label>
                     <select id="Indicador" name="Indicador" required>
                        <option value="Analisis Fisicoquimico">Análisis Físicoquímico</option>
                        <option value="Analisis Microbiologico">Análisis Microbiológico</option>
                    </select>
                </div>

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label>Análisis</label><br><br>
                    <label for="Cantidad_insumos">Cantidad de Insumos:</label>
                    <input type="number" id="Cantidad_insumos" name="Cantidad_insumos" placeholder="Cantidad" required>
                </div>
                <div>
                    <label for="ProductosT">Productos Terminados:</label>
                    <input type="number" id="ProductosT" name="ProductosT" placeholder="Cantidad" required>
                </div>
                <div>
                    <label for="ControlesD">Controles Diversos:</label>
                    <input type="number" id="ControlesD" name="ControlesD" placeholder="Cantidad" required>
                </div>
                <div>
                    <label for="MaterialesA">Materiales auxiliares:</label>
                    <input type="number" id="MaterialesA" name="MaterialesA" placeholder="Cantidad" required>
                </div>
                <div>
                    <label for="Total">Total:</label>
                    <input type="number" id="Total" name="Total" placeholder="Cantidad" required>
                </div>
            <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="TipoFormulario.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>