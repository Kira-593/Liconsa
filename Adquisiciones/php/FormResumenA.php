<!DOCTYPE html>
<html lang="es">
<head>
	<title>Adquisiciones</title>
	<meta charset="UTF-8">
    <script src="../js/cargas.js"></script>
    <script src="../js/SumaT.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/formResumenA.css">
    <img src="../imagenes/AgriculturaLogo.png" class="logo-superior" alt="Logo Agricultura">
	<img src="../imagenes/sgc.png" class="logo-sgc" alt="Logo SGC">	
    
</head>
<body>
<main class="container">

    <h1>Resumen de Adquisiciones</h1>
    
    <section class="registro">
        <form method="post" action="GuardarResumenA.php">
        <div class="registro-container">
            <div class="registro-column">

                <div>
                    <label for="Mes">Mes:</label>
                    <input type="date" id="Mes" name="Mes" required>
                </div>
                <div>
                    <label></label> <br><br>
                    <label for="CodigoTC">Codigo:</label>
                    <input type="number" id="CodigoTC" name="CodigoTC" placeholder="Ej. 1" required>
                </div>
                <div>
                    <label for="DescripcionBTD">Descripcion de los Bienes y/o Servicios:</label>
                    <input type="text" id="DescripcionBTD" name="DescripcionBTD" placeholder="Ej.EQUIPO DE PROTECCIÓN PERSONAL" required>
                </div>
                 <div>
                    <label for="MontoSIT">Monto sin Iva:</label>
                    <input type="number" id="MontoSIT" name="MontoSIT" placeholder="Ej. $33,434.48" required step="any">
                </div>
                <div>
                    <label for="LPAD">(LP,I3P,AD):</label>
                    <input type="text" id="LPAD" name="LPAD" placeholder="Ej. 55 PRIMER PARRAFO" required>
                </div>
                <div>
                    <label for="EmpresaATE">Empresa Adjudicada:</label>
                    <input type="text" id="EmpresaATE" name="EmpresaATE" placeholder="HOC MAC, S.A de CV" required>
                </div>
                 <div>
                    <label for="MontoSIT">Total Gerencia Estatal Tlaxcala:</label>
                    <input type="number" id="MontoSIT" name="MontoSIT" placeholder="Ej. $7,736,698.35" required step="any">
                </div>
                <div class="form-buttons">
                <input type="submit" name="g" value="Guardar">
                <input type="reset" name="b" value="Limpiar">
            </div>
        </form>
    </section>
    <a href="AdquisicionesP.php" class="home-link">
        <img src="../imagenes/home.png" height="100" width="90">
    </a>
</main>

</body>
</html>