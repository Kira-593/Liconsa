<!DOCTYPE html>
<html lang="es">
<head>
	<title>Rutas de Distribución</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formRutas.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Rutas de Distribución y Litros Desplazados</h1>
    
    <section class="registro">
        <form method="post" action="GuardarRutas.php">
        <div class="registro-container">
            <div class="registro-column">

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <hr>
                    <label>Transporte Propio</label><br>
                    <hr>
                    <label for="LitrosTRuno">Litros Desplazados de R1:</label>
                    <input type="number" id="LitrosTRuno" name="LitrosTRuno" placeholder="Ej. 185,220" required>
                </div>
                <div>
                    <label for="PorcentajeTRuno">Porcentaje que Representa R1:</label>
                    <input type="number" id="PorcentajeTRuno" name="PorcentajeTRuno" placeholder="Ej. 27%" required>
                </div>
                <div>
                    <label for="LitrosTRdos">Litros Desplazados de R2:</label>
                    <input type="number" id="LitrosTRdos" name="LitrosTRdos" placeholder="Ej. 184,680" required>
                </div>
                <div>
                    <label for="PorcentajeTRdos">Porcentaje que Representa R2:</label>
                    <input type="number" id="PorcentajeTRdos" name="PorcentajeTRdos" placeholder="Ej. 26%" required>
                </div>
                <div>
                    <label for="LitrosTRtres">Litros Desplazados de R3:</label>
                    <input type="number" id="LitrosTRtres" name="LitrosTRtres" placeholder="Ej. 202,300" required>
                </div>
                <div>
                    <label for="PorcentajeTRtres">Porcentaje que Representa R3:</label>
                    <input type="number" id="PorcentajeTRtres" name="PorcentajeTRtres" placeholder="Ej. 29%" required>
                </div>
                <div>
                    <label for="LitrosTRcuatro">Litros Desplazados de R4:</label>
                    <input type="number" id="LitrosTRcuatro" name="LitrosTRcuatro" placeholder="Ej. 126,000" required>
                </div>
                <div>
                    <label for="PorcentajeTRcuatro">Porcentaje que Representa R4:</label>
                    <input type="number" id="PorcentajeTRcuatro" name="PorcentajeTRcuatro" placeholder="Ej. 18%" required>
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