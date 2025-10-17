<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaAprovechamieto.js"></script>
    <script src="../js/Multiplicaciondias.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formConsEnergia.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
    <img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">
</head>
<body>
<main class="container">

    <h1>Formulario de Consumo de Energía Termica y Electrica</h1>
    <section class="registro">
        <form method="post" action="GuardarConsEnergia.php">
        <div class="registro-container">
            <div class="registro-column">
                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <hr>
                 <th><h5>Consumo de Energía Termica(Diesel)</h5></th>
                 <hr>
                <div>
                    <label for="CantidadDieselCTC">Cantidad de Litros de Diesel consumidos:</label>
                    <input type="number" id="CantidadDieselCTC" name="CantidadDieselCTC" placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITD">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionITD" name="ReduccionITD" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRID">Promedio de Reducción o Incremento:</label>
                    <input type="number" id="PromedioRID" name="PromedioRID" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="LitrosDLL">Litros de Diesel por litro de leche producida:</label>
                    <input type="number" id="LitrosDLL" name="LitrosDLL" placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionILD">Reducción(-) o Incremento(+) de litros de diesel /Litros leche en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionILD" name="ReduccionILD" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRILD">Promedio de Reducción o Incremento de litros de diesel /Litros leche:</label>
                    <input type="number" id="PromedioRILD" name="PromedioRILD" placeholder="%" required step="any">
                </div>
                <hr>
                <th><h5>Consumo de Energía Electrica</h5></th>
                <hr>
                <div>
                    <label for="CantidadEnergiaCTC">Cantidad de Energía consumida:</label>
                    <input type="number" id="CantidadEnergiaCTC" name="CantidadEnergiaCTC" placeholder="Kw/hr" required step="any">
                </div>
                
                <div>
                    <label for="ReduccionITR">Reducción(-) o Incremento(+) en Comparacion al Mismo Mes del Año Anterior:</label>
                    <input type="number" id="ReduccionITR" name="ReduccionITR" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIT">Promedio de Reducción o Incremento:</label>
                    <input type="number" id="PromedioRIT" name="PromedioRIT" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="CantidadLLT">Cantidad de Kw por litro de leche producida.:</label>
                    <input type="number" id="CantidadLLT" name="CantidadLLT" placeholder="Kw/Litros" required step="any">
                </div>
                <div>
                    <label for="ReduccionIKL">Reducción(-) o Incremento(+) de Kw/Litros en Comparacion al Mismo Mes del AñoAnterior:</label>
                    <input type="number" id="ReduccionIKL" name="ReduccionIKL" placeholder="%" required step="any">
                </div>
                <div>
                    <label for="PromedioRIK">Promedio de Reducción o Incremento de Kw/Litros:</label>
                    <input type="number" id="PromedioRIK" name="PromedioRIK" placeholder="%" required step="any">
                </div>
                

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