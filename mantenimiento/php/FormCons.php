<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formCons.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">

    <h1>Formulario de Consumo de Energía y Producción</h1>
    <section class="registro">
        <form method="post" action="Guardar.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label for="ProduccionLecheTP">Producción de Leche Total Mensual:</label>
                    <input type="number" id="ProduccionLecheTP" name="ProduccionLecheTP" placeholder="Litros" required>
                </div>
                <div>
                    <label for="ReduccionITR">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR" name="ReduccionITR" placeholder="%" required>
                </div>
                <hr>
    
                <div>
                    <label for="EnergiaElectricaTE">Energía Eléctrica Total Mensual:</label>
                    <input type="number" id="EnergiaElectricaTE" name="EnergiaElectricaTE" placeholder="kW/hr" required>
                </div>
                <div>
                    <label for="EnergiaElectricaTEG">Energía Eléctrica Total Mensual en GJ:</label>
                    <input type="number" id="EnergiaElectricaTEG" name="EnergiaElectricaTEG" placeholder="GJ" required>
                </div>
                <div>
                    <label for="ReduccionITR">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR" name="ReduccionITR" placeholder="%" required>
                </div>
                <hr>
                <div>
                    <label for="ConsumoDieselTP">Consumo de Diesel Total Mensual:</label>
                    <input type="number" id="ConsumoDieselTP" name="ConsumoDieselTP" placeholder="Litros" required>
                </div>
                <div>
                    <label for="ConsumoDieselTPG">Consumo de Diesel Total Mensual EN GJ:</label>
                    <input type="number" id="ConsumoDieselTPG" name="ConsumoDieselTPG" placeholder="GJ" required>
                </div>
                <div>
                    <label for="ReduccionITR">Reducción(-) e Incremento(+):</label>
                    <input type="number" id="ReduccionITR" name="ReduccionITR" placeholder="%" required>
                </div>
                <hr>
               
                

                <div>
                 
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