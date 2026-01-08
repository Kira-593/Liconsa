<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formRCT.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
<main class="container">

    <h1>Formulario de Captación de Leche</h1>
    
    <section class="registro">
        <form method="post" action="GuardarRCT.php">
        <div class="registro-container">
            
            <!-- Columna 1 -->
            <div class="registro-column">
                <div>
                    <label for="Provedor">Provedor:</label>
                    <input type="text" id="Provedor" name="Provedor" placeholder="Ej. Nombre, locacion, periodo" required>
                </div>

                <div>
                    <label for="Folio">Folio:</label>
                    <input type="number" id="Folio" name="Folio" placeholder="Ej. 151" required>
                </div>

                <div>
                    <label for="FechaDictamen">Fecha de Dictamen:</label>
                    <input type="date" id="FechaDictamen" name="FechaDictamen" placeholder="Ej. 01/07/2025" required>
                </div>

                <div>
                    <label for="Remision">Remisión:</label>
                    <input type="text" id="Remision" name="Remision" placeholder="Ej. SJU-481" required>
                </div>

                <div>
                    <label for="Densidad">Densidad (g/mL):</label>
                    <input type="number" step="0.0001" id="Densidad" name="Densidad" placeholder="Ej. 1.0315" required>
                </div>

                <div>
                    <label for="Volumen">Volumen (Litros):</label>
                    <input type="number" step="0.01" id="Volumen" name="Volumen" placeholder="Ej. 14,009" required>
                </div>

                <div>
                    <label for="Grasa">Grasa (g/L):</label>
                    <input type="number" step="0.1" id="Grasa" name="Grasa" placeholder="Ej. 38.3" required>
                </div>

              
            </div>
            
            <!-- Columna 2 -->
            <div class="registro-column">
                  <div>
                    <label for="SNG">S.N.G. (g/L):</label>
                    <input type="number" step="0.1" id="SNG" name="SNG" placeholder="Ej. 90.1" required>
                </div>
                <div>
                    <label for="Proteina">Proteína (g/L):</label>
                    <input type="number" step="0.1" id="Proteina" name="Proteina" placeholder="Ej. 32.8" required>
                </div>

                <div>
                    <label for="Caseina">Caseína (g/L):</label>
                    <input type="number" step="0.1" id="Caseina" name="Caseina" placeholder="Ej. 25.5" required>
                </div>

                <div>
                    <label for="Acidez">Acidez (g/L):</label>
                    <input type="number" step="0.01" id="Acidez" name="Acidez" placeholder="Ej. 1.45" required>
                </div>

                <div>
                    <label for="Temperatura">Temperatura (°C):</label>
                    <input type="number" step="0.1" id="Temperatura" name="Temperatura" placeholder="Ej. 5" required>
                </div>

                <div>
                    <label for="PH">P.C. °H:</label>
                    <input type="number" step="0.001" id="PH" name="PH" placeholder="Ej. -0.546" required>
                </div>

                <div>
                    <label for="Reductasa">Reductasa (min):</label>
                    <input type="number" id="Reductasa" name="Reductasa" placeholder="Ej. 340" required>
                </div>
            </div>
            
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