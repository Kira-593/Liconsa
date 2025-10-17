<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formGPS.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
<main class="container">

        <h1>Formulario de Determinación</h1>
        
        <section class="registro">
            <form method="post" action="HacerGPS.php">
            <div class="registro-container">
                <div class="registro-column">
                    <div>
                        <label for="Indicador">Tipo de Determinación</label>
                        <select id="Indicador" name="Indicador" required>
                            <option value="Determinacion de Grasa">Determinación de Grasa</option>
                            <option value="Determinacion de Proteina">Determinación de Proteína</option>
                            <option value="Determinacion de Solidos No  Grasos">Determinación de Sólidos No Grasos</option>
                        </select>
                    </div>

                    <div>
                        <label for="Mes">Mes:</label>
                        <input type="date" id="Mes" name="Mes" required>
                    </div>
                    <div>
                        <label for="Metodo">Método:</label>
                        <input type="text" id="Metodo" name="Metodo" placeholder="MILKO SCAN" required>
                    </div>
                    <div>
                        <label for="Muestra">Muestra:</label>
                        <input type="text" id="Muestra" name="Muestra" placeholder="Leche fortificada" required>
                    </div>
                    <div>
                        <label for="ValorR">Valor de Referencia:</label>
                        <input type="number" id="ValorR" name="ValorR" placeholder="30.52" required>
                    </div>
                    <div>
                        <label for="ValorMax">Valor Máximo:</label>
                        <input type="number" id="ValorMax" name="ValorMax" placeholder="34.00" required step="any">
                    </div>
                    <div>
                        <label for="ValorMin">Valor Mínimo:</label>
                        <input type="number" id="ValorMin" name="ValorMin" placeholder="13.3" required step="any">
                    </div>
                    <div>
                        <label for="UnidadesKG">Promedio Mensual:</label>
                        <input type="number" id="UnidadesKG" name="UnidadesKG" placeholder="84.84" required step="any">
                    </div>
                    

                <div class="form-buttons"> 
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>
            </div>
            </form>
        </section>

        <a href="TipoFormulario.php" class="home-link">
            <img src="../imagenes/home.png" height="100" width="90">
        </a>
    </main>

</body>
</html>
