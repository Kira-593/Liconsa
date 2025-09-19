<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro de Leche</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formEvaluacion.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
</head>
<body>
<main class="container">

    <h1>Formulario de Evaluacion del desempeño</h1>
    
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>

                <div>
                    <label for="ServiciosSTS">Servicios Solicitados:</label>
                    <input type="Text" id="ServiciosSTS" name="ServiciosSTS" placeholder="No.Serv." required>
                </div>

               <div>
                    <label for="ServiciosATS">Servicios Atendidos en Tiempo:</label>
                    <input type="Text" id="ServiciosATS" name="ServiciosATS" placeholder="No.Serv." required>
                </div>

                <div>
                    <label for="PorcentajeCTP">Porcentaje de cumplimiento:</label>
                    <input type="text" id="PorcentajeCTP" name="PorcentajeCTP" placeholder="Ej. 95%" required>
                </div>

                <div>
                    <label for="MetaTM">Meta:</label>
                    <input type="number" step="0.0001" id="MetaTM" name="MetaTM" placeholder="Ej. MIN. 95%" required>
                </div>


                <div class="form-buttons">
                    <input type="submit" name="g" value="Guardar">
                    <input type="reset" name="b" value="Limpiar">
                </div>

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
