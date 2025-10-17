<!DOCTYPE html>
<html lang="es">
<head>
	<title>Factor de Retiro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formFactor.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Factor de Retiro</h1>
    
    <section class="registro">
        <form method="post" action="GuardarFactor.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Indicador">Tipo de Leche</label>
                    <select id="Indicador" name="Indicador" required>
                        <option value="Liquida de Abasto">Liquida de Abasto</option>
                        <option value="Polvo de Abasto">Polvo de Abasto</option>
                    </select>
                </div>

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label>Cantidad Mensual Mensual</label><br><br>
                    <label for="FactorRTF">Factor de Retiro Minimo:</label>
                    <input type="number" id="FactorRTF" name="FactorRTF" placeholder="Ej. 301" required>
                </div>
                <div>
                    <label for="AlcanceTA">Alcance del Mes:</label>
                    <input type="number" id="AlcanceTA" name="AlcanceTA" placeholder="Ej. 361" required>
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